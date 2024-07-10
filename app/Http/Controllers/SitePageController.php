<?php

namespace App\Http\Controllers;

use App\Mail\ExampleMail;
use App\Models\leaders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SitePageController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function page($slug)
    {
        $contents = DB::table('pages')->where('slug', $slug)->get();
        if (count($contents) > 0) {
            return view('blocks.pages', compact('contents'));
        } else {
            abort(404);
        }

    }

    public function leadership()
    {
        $leaders = DB::table('leaders')->orderBy('position', 'asc')->get();
        return view('blocks.leadership', compact('leaders'));
    }

    public function all($type)
    {
        if ($type == 'news') {
            $news = DB::select("SELECT * from `news` where `type_of_news` = 1 order by `news`.`sana` DESC ");
        } elseif ($type == 'tadbirlar') {
            $news = DB::select("SELECT * from `news` where `type_of_news` = 3 order by `news`.`sana` DESC ");
        } elseif ($type == 'e\'lonlar') {
            $news = DB::select("SELECT * from `news` where `type_of_news` = 2 order by `news`.`sana` DESC ");
        } else {
            abort(404);
        }

        return view('blocks.all', compact(['news', 'type']));

    }

    public function view($type, $slug)
    {
        if ($type == 'news') {
            $views = DB::select("SELECT * from `news` where `type_of_news` = 1 and `slug` = '$slug' ");
        } elseif ($type == 'tadbirlar') {
            $views = DB::select("SELECT * from `news` where `type_of_news` = 3 and `slug` = '$slug' ");
        } elseif ($type == 'e\'lonlar') {
            $views = DB::select("SELECT * from `news` where `type_of_news` = 2 and `slug` = '$slug' ");
        } else {
            abort(404);
        }
        if (count($views) > 0) {
            return view('blocks.view', compact(['views', 'type']));
        } else {
            abort(404);
        }

    }

    public function faq()
    {
        return view('blocks.faq');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('pages')
            ->where('body', 'LIKE', '%' . $search . '%')
            ->orWhere('title', 'LIKE', '%' . $search . '%')
            ->get();

        return view('blocks.result', compact('query', 'search'));
    }

    public function gallery()
    {
        return view('blocks.gallery');
    }

    public function video()
    {
        return view('blocks.video');
    }

    public function contact()
    {
        return view('blocks.contact');
    }

    public function sendEmail(Request $request)
    {

        // Извлечение данных из запроса без валидации
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $subject = $request->input('subject');
        $messageContent = $request->input('message');

        // Отправка письма
        Mail::send([], [], function ($message) use ($name, $email, $phone, $subject, $messageContent) {
            $message->to('recipient@example.com')
                ->subject($subject)
                ->setBody(
                    '<p><strong>Name:</strong> ' . $name . '</p>' .
                    '<p><strong>Email:</strong> ' . $email . '</p>' .
                    '<p><strong>Phone:</strong> ' . $phone . '</p>' .
                    '<p><strong>Message:</strong> ' . nl2br($messageContent) . '</p>',
                    'text/html'
                );
        });
        return redirect(url('/contact'));

//        return back()->with('success', 'Email sent successfully!');

    }
}
