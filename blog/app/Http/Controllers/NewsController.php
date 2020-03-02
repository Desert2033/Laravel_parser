<?php

namespace App\Http\Controllers;

use App\classes\Parser;
use App\User;
use Illuminate\Http\Request;
use App\News;
use App\Http\Requests\NewsRequest;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\PhpMailer\PHPMailer;

class NewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function StartParseNews()
    {
        $countNews = News::where('id_user', Auth::id())->count();

        if ($countNews != 0) {

            return redirect()->route('home');
        }

        $countNews = 3;
        $parser = new Parser();
        $parser->setCount($countNews);
        $mass_news = $parser->Parse();


       $this->insertNews($mass_news);

        return redirect()->route('home');

    }
    public function ParseNewsByCount($count){
        $parser = new Parser();
        $parser->setCount($count);
        $mass_news = $parser->Parse();

        $this->insertNews($mass_news);

    }

    public function insertNews($mass_news){

        foreach ($mass_news as $key => $val){
            News::create(['title' => $mass_news[$key]['title'], 'date' => $mass_news[$key]['date'], 'text' => $mass_news[$key]['text'],
                'authors' => $mass_news[$key]['authors'], 'id_user' => Auth::id(), 'image' => $mass_news[$key]['image']]);
        }

    }
    public function deleteAllNews(){
        News::where('id_user', Auth::id())->delete();
    }

    public function addNews(){
       return view('add');
    }
    public function addNewsSubmit(NewsRequest $request){

        $news = new News();

        $news->title = $request->input('title');
        $news->authors = $request->input('authors');
        $news->text = $request->input('text');
        $news->id_user = Auth::id();

        $date = $request->input('date');
        $date = new DateTime($date);
        $date = date_format($date, 'F d\, Y');
        $news->date = $date;

        if (file_exists($_FILES['image']['tmp_name']))
        {
            $image = file_get_contents($_FILES['image']['tmp_name']);//image
            $image = base64_encode($image);
            $image = addslashes($image);
            $news->image = $image;
        }
        else{
            $news->image = null;
        }

        $result = $news->save();

        if ($result)
        {
            return redirect()->route('home')->with('success', 'News successfully add');
        }
        else
        {
            return redirect()->route('home')->with('no_success', 'News was not add');
        }
    }

    public function editNews($id){
        $news = News::find($id);

        $date = new DateTime($news->date);
        $date = date_format($date, 'Y-m-d');
        $news->date = $date;
        return view('edit', ['data' => $news]);
    }
    public function  editNewsSubmit($id, NewsRequest $request){

        $news = News::find($id);

        $news->title = $request->input('title');
        $news->authors = $request->input('authors');
        $news->text = $request->input('text');

        $date = $request->input('date');
        $date = new DateTime($date);
        $date = date_format($date, 'F d\, Y');
        $news->date = $date;

        if (file_exists($_FILES['image']['tmp_name']))
        {
            $image = file_get_contents($_FILES['image']['tmp_name']);//image
            $image = base64_encode($image);
            $image = addslashes($image);
            $news->image = $image;
        }

        $result = $news->save();

        if ($result)
        {
            return redirect()->route('home')->with('success', 'News successfully edit');
        }
        else
        {
            return redirect()->route('home')->with('no_success', 'News was not edit');
        }
    }

    public function deleteNews(Request $request){
        $news_id = $request->all();
        unset($news_id['_token']);
        foreach ($news_id as $news)
        {
            News::find($news)->delete();
        }

        return redirect()->route('home')->with('success', 'News successfully delete');

    }

    public function updateAllNews(){
        $count = News::where('id_user', Auth::id())->count();
        if ($count == 0){
            $count = 3;
        }
        $this->deleteAllNews();
        $this->ParseNewsByCount($count);

        return redirect()->route('home')->with("success","All news successfully update");
    }

    public function sendToEmail(Request $request){
        $news_id = $request->all();
        unset($news_id['_token']);
        $mass_news = News::find($news_id);
        $this->saveNewsInFile($mass_news);

        $mail = new PHPMailer();
        $handle = storage_path('app/file.csv');

        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = "ssl";
        $mail->SMTPAuth   = true;
        $mail->Port = 465;
        $mail->Username   = 'testsitea2033@gmail.com'; // Логин на почте
        $mail->Password   = 'site2033'; // Пароль на почте
        $mail->setFrom('testsitea2033@gmail.com', 'Aртур Тарнавский');

        $mail->Subject = 'FILEEE';
        $mail->isHTML(true);
        $mail->Subject = 'FILEEE';
        $mail->Body    = "<b>Имя: </b> Artur<br>
        <b>Почта:</b> tarnavskiy18@gmail.com <br><br>
        <b>Сообщение:</b><br> file csv";
        $email = Auth::user()->email;

        $mail->addAddress($email, "Arturrr");

        $mail->addAttachment($handle);

        if (!$mail->send()) {
            return redirect()->route('home')->with('success', 'News not successfully send to email');
        }

        return redirect()->route('home')->with('success', 'News successfully send to email');


    }

    public function saveNewsInFile($mass_news){

        $news = $mass_news->map(function ($mass_news) {
            return $mass_news->only(['id', 'title', 'authors', 'date', 'text', 'image', 'id_user']);
        });

        $handle = storage_path('app/file.csv');
        $handle = fopen($handle, 'w+');


        foreach ($news as $key => $value)
        {
            fputcsv($handle, $news[$key]);
        }

        fclose($handle);

    }

    public function searchNews(Request $request){

        $str = $request->input('search');
        $news = News::where('id_user', Auth::id())->paginate(12);

        foreach ($news as $key => $value){
            $strNews = $news[$key]['title'].' '.$news[$key]['authors'].' '.$news[$key]['date'].' '.$news[$key]['text'];
            if(!mb_strstr($strNews, $str)){
                unset($news[$key]);
            }
        }
        return view('mainPage', compact('news'));
    }

}

