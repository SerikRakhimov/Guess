<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mail;

class HomeController extends Controller
{
    protected function rules_answer()
    {
        return [
            'answer' => [
                'required',
                'max:25',
                new \App\Rules\AnswerOneWord,
                new \App\Rules\AnswerUcfirst,
                new \App\Rules\AnswerCyrillic,
                new \App\Rules\AnswerTrueWords
            ]
        ];
    }

    protected function rules_question()
    {
        // new \App\Rules\QuestionMoreThanOneWord,
        return [
            'question' => [
                'required',
                'max:100',
                new \App\Rules\QuestionUcfirst,
                new \App\Rules\QuestionLastSymbol
            ]
        ];
    }

    public function index()
    {
        $count = \App\Models\Main::count();
        if ($count == 0) {
            $main = new \App\Models\Main();
            $main->question = "Домашнее животное";
            $main->answer = "Кошка";
            $main->yes_id = 0;
            $main->no_id = 0;
            $main->notknow_id = 0;
            $main->url = "https://www.zastavki.com/pictures/originals/2014/Animals___Cats_Yellow-eyed_American_Shorthair_092089_.jpg";

            $main->save();
        }

	//	Mail::send(['html'=>'mail_run'], ['remote_addr'=>$_SERVER['REMOTE_ADDR'], 'http_user_agent'=>$_SERVER['HTTP_USER_AGENT']], function($message){
	//		$message->to('s_astana@mail.ru','')->subject('Игра запущена');
	//		$message->from('admin@guess.rsb0807.kz','Игра Задумай-угадаю');
	//	});
		
        $count = \App\Models\Main::count();  // нужно
        $main = \App\Models\Main::on()->first();

        return view('home', ['main' => $main, 'count' => $count]);
    }

    public function question($id)
    {

        $main = \App\Models\Main::find($id);

        return view('question', ['id' => $id, 'main' => $main]);
    }

    public function answer($id, $type, $id_calc)
    {
        $main = \App\Models\Main::find($id);
        $url_exists = false;
        if ($main) {
            $url_exists = $main->url != "";
        }
        return view('answer', ['id' => $id, 'type' => $type, 'id_calc' => $id_calc, 'url_exists' => $url_exists, 'main' => $main]);
    }

    public function guessed($id)
    {
        $main = \App\Models\Main::find($id);
        if ($main) {
            $url_exists = false;
            if ($main) {
                $url_exists = $main->url != "";
            }
			
		//	Mail::send(['html'=>'mail_guessed'], ['url_exists'=>$url_exists, 'url'=>$main->url, 'answer'=>$main->answer, 'remote_addr'=>$_SERVER['REMOTE_ADDR'], 										'http_user_agent'=>$_SERVER['HTTP_USER_AGENT']], function($message){
		//		$message->to('s_astana@mail.ru','')->subject('Слово угадано');
		//		$message->from('admin@guess.rsb0807.kz','Игра Задумай-угадаю');
		//	});
		
            return view('guessed', ['url_exists' => $url_exists, 'main' => $main]);
        } else {
            // вывести "Слово с id = xxx не найдено!"
            return view('answer', ['id' => $id, 'main' => $main]);
        }
    }

    function create_answer($parent_id, $type)
    {
        return view('form_answer', ['parent_id' => $parent_id, 'type' => $type]);
    }

    function store_answer(Request $request)
    {
        $request->validate($this->rules_answer());

        $parent_id = $request['parent_id'];
        $type = $request['type'];
        $answer = $request['answer'];
        $main = \App\Models\Main::find($parent_id);

        if ($main) {
            return redirect()->route('home.create_question', ['parent_id' => $parent_id, 'type' => $type, 'answer' => $answer]);
        } // вывести "Вопрос с id = xxx не найден!"
        else {
            return redirect()->route('home.question', ['id' => $parent_id, 'main' => $main]);
        }

    }

    function create_question($parent_id, $type, $answer)
    {
        $main = \App\Models\Main::find($parent_id);
        if ($main) {
            return view('form_question', ['parent_id' => $parent_id, 'type' => $type, 'answer' => $answer, 'parent_answer' => $main->answer]);
        } // вывести "Вопрос с id = xxx не найден!"
        else {
            return view('question', ['id' => $parent_id, 'main' => $main]);
        }
    }

    function store_question(Request $request)
    {
        $request->validate($this->rules_question());

        $parent_id = $request['parent_id'];
        $type = $request['type'];
        $answer = $request['answer'];
        $question = $request['question'];

        $main = \App\Models\Main::find($parent_id);
        if ($main) {
            return redirect()->route('home.create_url', ['parent_id' => $parent_id, 'type' => $type, 'answer' => $answer, 'question' => $question]);
        } // вывести "Вопрос с id = xxx не найден!"
        else {
            return redirect()->route('home.question', ['id' => $parent_id, 'main' => $main]);
        }

    }

    function create_url($parent_id, $type, $answer, $question)
    {
        $main = \App\Models\Main::find($parent_id);
        if ($main) {
            return view('form_url', ['parent_id' => $parent_id, 'type' => $type, 'answer' => $answer, 'question' => $question]);
        } // вывести "Вопрос с id = xxx не найден!"
        else {
            return view('question', ['id' => $parent_id, 'main' => $main]);
        }
    }

    function store_url(Request $request)
    {
        $parent_id = $request['parent_id'];
        $type = $request['type'];
        $answer = $request['answer'];
        $question = $request['question'];
        $url = $request['url'];

        $url_exists = $url != "";

        return view('view_main', ['parent_id' => $parent_id, 'type' => $type, 'answer' => $answer, 'question' => $question, 'url' => $url, 'url_exists' => $url_exists]);

    }

    function store_main(Request $request)
    {

        // установка часового пояса нужно для сохранения времени
        date_default_timezone_set('Asia/Almaty');

        $parent_id = $request['parent_id'];
        $type = $request['type'];
        $parent = \App\Models\Main::find($parent_id);
        $message = "";  // нужно
        $id = 0;
        if ($parent) {
            try {
                DB::transaction(function ($r) use ($request, $type, $parent, &$id, &$message) {
                    $main = new \App\Models\Main();
                    $main->question = $request['question'];
                    $main->answer = $request['answer'];
                    $main->yes_id = 0;
                    $main->no_id = 0;
                    $main->notknow_id = 0;
                    // проверка нужна (если пользователь не ввел URL картинки)
                    if ($request['url'] == null) {
                        $main->url = "";
                    } else {
                        $main->url = $request['url'];
                    }


                    $main->save();

                    $id = $main->id;
                    switch ($type) {
                        case 1:
                            if ($parent->yes_id == 0) {
                                $parent->yes_id = $id;
                            } else {
                                $message = "Ветку 'Да' уже занял другой игрок! Попробуйте пройти заново с вашим словом.";
                            }
                            break;
                        case 2:
                            if ($parent->no_id == 0) {
                                $parent->no_id = $id;
                            } else {
                                $message = "Ветку 'Нет' уже занял другой игрок! Попробуйте пройти заново с вашим словом.";
                            }
                            break;
                        case 3:
                            if ($parent->notknow_id == 0) {
                                $parent->notknow_id = $id;
                            } else {
                                $message = "Ветку 'Не знаю' уже занял другой игрок! Попробуйте пройти заново с вашим словом.";
                            }
                            break;
                        default:
                        {
                            $message = "Переменная type не равна 1, 2 или 3.";
                        }
                    }
                    if ($message == "") {
                        $parent->save();
                        $result = 1;
                    } else {
                        DB::rollBack();
                        $result = 2;
                    }
                }, 3);  // Повторить три раза, прежде чем признать неудачу

                if ($message == "") {
                    $main = \App\Models\Main::find($id);
                    if ($main) {
                        $url = $main->url;
                        $url_exists = $url != "";
                        
				//		Mail::send(['html'=>'mail_saved'], ['url_exists'=>$url_exists, 'url'=>$url, 'question' => $main->question, 'answer'=>$main->answer, 'remote_addr'=>$_SERVER['REMOTE_ADDR'], 										'http_user_agent'=>$_SERVER['HTTP_USER_AGENT']], function($message){
				//		$message->to('s_astana@mail.ru','')->subject('Данные сохранены.');
				//		$message->from('admin@guess.rsb0807.kz','Игра Задумай-угадаю');
				//		});
					
						return view('saved_main', ['question' => $main->question, 'answer' => $main->answer, 'url' => $url, 'url_exists' => $url_exists]);
						
                    } else {
                        return view('nosaved_main', ['message' => "Вопрос с id = " . $id . " не найден!"]);
                    }
                } else {
                    return view('nosaved_main', ['message' => $message]);
                }

            } catch (ExternalServiceException $exception) {
                return view('nosaved_main', ['message' => "Транзакция не завершена."]);
            }

        } else {
            return view('nosaved_main', ['message' => "Не найден вопрос по id = " . $parent_id] . ".");
        }

    }

}
