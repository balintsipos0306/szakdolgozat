<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\Subscription;

class MailController extends Controller
{
    public function sendMail(Request $request){
    
        $request->validate([
            'address' => 'required|email',
            'name' => 'required|string|max:255',
            'title' => 'required|string',
            'text' => 'required|string'
        ]);
        $address = $request->input('address');
        $name = $request->input('name');
        $text = $request->input('text');

        $body = '
            <div style="margin: auto; padding: 1em; color:#3F4E4F; margin: 1em; border-radius: 10px;font-family: Trebuchet MS; box-shadow: 20px 20px 50px grey;">
            <div style="text-align: center"><div style="margin:auto;background-color: white; width: fit-content;padding:1em;border-radius: 100%;"><img src="cid:logoimg" style="margin: auto; height: 5em; width: auto;"></div></div>
            <h3 style="margin: auto; text-align: center;">Feladó: ' . $name . ' </h3>
            <h4 style="margin: auto; text-align: center;">Email: ' . $address . ' </h4>
            <hr>
            <p>'. $text .'</p>
            </div>
        ';

         return $this->mailHelper($address, $name, $request->input('title'), $body);
    }

    public function Subscribe(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'name' => 'required|string',
        ]);

        $address = $request->input('email');
        $name = $request->input('name');
        $body = '
                <div style=" margin: auto; padding: 1em; color:#3F4E4F; margin: 1em; border-radius: 10px;font-family: Trebuchet MS; box-shadow: 20px 20px 50px grey;">
                <div style="text-align: center"><div style="margin:auto;background-color: white; width: fit-content;padding:1em;border-radius: 100%;"><img src="cid:logoimg" style="margin: auto; height: 5em; width: auto;"></div></div>
                <h1 style="margin: auto; text-align: center;">Kedves ' . $name . '</h1>
                <hr>
                <p>Köszönöm hogy feliratkoztál a hírlevelemre.
                Minden új blog bejegyzésről, vagy webshop termékekről elsőként fogsz értesítést kapni, hogy ne maradj le semmiről</p>
                <br>
                <div style="margin: auto;text-align: center;"><a href="http://localhost:8000/unSubscribe?email=' . urlencode($address) . '&name=' . urlencode($name) . '" style="background-color: #3F4E4F; color: white;padding: 10px; border-radius: 10px; text-decoration: none;">Leiratkozás</a></div>
                </div> 
            ';

        return $this->mailHelper($address, $name, "Sikeres feliratkozás", $body);
    }

    public function sendMailToSub(Request $request){
        $request->validate([
            'title'=>'required|string',
            'text'=>'required|string'
        ]);
        $title = $request->input('title');
        $text = $request->input('text');
        
        $subs = Subscription::all();
        foreach($subs as $subscriber){
            $body='
            <div style="margin: auto; padding: 1em; color:#3F4E4F; margin: 1em; border-radius: 10px;font-family: Trebuchet MS; box-shadow: 20px 20px 50px grey;">
            <div style="text-align: center"><div style="margin:auto;background-color: white; width: fit-content;padding:1em;border-radius: 100%;"><img src="cid:logoimg" style="margin: auto; height: 5em; width: auto;"></div></div>
            <h1 style="margin: auto; text-align: center;">Kedves '. $subscriber->name .'!</h1>
            <hr>
            <p>'. $text .'</p>
            <br>
            <hr style="width:80%;margin-top:10em;">
            <div>
            <p style="text-align: center;font-size: 0.7em;"><i>Ezt az emailt kapod mert korábban feliratkoztál a hírlevelemre. Ha nem szeretnél több ilyen emailt kapni az alábbi gombra kattintva tudsz leiratkozni</i></p>
            <div style="margin: auto;text-align: center;"><a href="http://localhost:8000/unSubscribe?email=' . urlencode($subscriber->email) . '&name=' . urlencode($subscriber->name) . '" style="background-color: #3F4E4F; color: white;padding: 10px; border-radius: 10px; text-decoration: none;">Leiratkozás</a></div>
            </div>
            </div>
            ';
            
            $this->mailHelper($subscriber->email, $subscriber->name, $title, $body);
        }
        $emails = $subs->pluck('email')->toArray();
        return redirect()->action([NewsletterController::class, 'saveSentNewsletter'], ['title'=> $title,
                                                                                            'body' => $text,
                                                                                            'emails' => $emails]);
    }

    public function newBlogToMail(Request $request){
        $title = $request->input('title');
        $text = $request->input('text');
        $imagePath = public_path('storage/' . $request->input('imagePath'));
        $id = $request->input('id');
        
        $subs = Subscription::all();
        foreach($subs as $subscriber){
            $body='
            <div style="margin: auto; padding: 1em; color:#3F4E4F; margin: 1em; border-radius: 10px;font-family: Trebuchet MS; box-shadow: 20px 20px 50px grey;">
                <div style="text-align: center"><div style="margin:auto;background-color: white; width: fit-content;padding:1em;border-radius: 100%;"><img src="cid:logoimg" style="margin: auto; height: 5em; width: auto;"></div></div>
                <h3 style="margin: auto; text-align: center;"><i>Új blog bejegyzés:</i></h3>
                <h1 style="margin: auto; text-align: center;">'. $title .'</h1>
                <hr>
                <p><h2>Kedves '. $subscriber->name .'!</h2></p>
                <p>Most jelent meg az új blogom "'. $title .'" címel. Kattints a gombra, hogy elolvasd.</p>
                <div style="text-align: center;margin-bottom: 1em; width:100%"><img src="cid:blogImage" style="margin: auto; width: 100%; height: auto;"></div>
                <p style="width: 90%; margin: auto; text-align: center;margin-bottom: 2.5em;">'. $text .'</p>
                <div style="margin:auto;text-align: center;"><a href="http://localhost:8000/blog/'. $id .'" style="background-color: #3F4E4F; color: white;padding: 15px; border-radius: 10px; text-decoration: none;">Megnyitás</a></div>
                <br>
                <hr style="width:80%;margin-top:10em;">
                <div>
                    <p style="text-align: center;font-size: 0.7em;"><i>Ezt az emailt kapod mert korábban feliratkoztál a hírlevelemre. Ha nem szeretnél több ilyen emailt kapni az alábbi gombra kattintva tudsz leiratkozni</i></p>
                    <div style="margin: auto;text-align: center;"><a href="http://localhost:8000/unSubscribe?email=' . urlencode($subscriber->email) . '&name=' . urlencode($subscriber->name) . '" style="background-color: #3F4E4F; color: white;padding: 10px; border-radius: 10px; text-decoration: none;">Leiratkozás</a></div>
                </div>
            </div>
            ';

            $this->mailHelper($subscriber->email, $subscriber->name, $title, $body, $imagePath);
        }

        return redirect('/admin/blog')->with('success', 'Blog feltöltve - email elküldve');
    }


    public function newAcc(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'name' => 'required|string',
        ]);

        $address = $request->input('email');
        $name = $request->input('name');

        $body = '
                <div style=" margin: auto; padding: 1em; color:#3F4E4F; margin: 1em; border-radius: 10px;font-family: Trebuchet MS; box-shadow: 20px 20px 50px grey;">
                <div style="text-align: center"><div style="margin:auto;background-color: white; width: fit-content;padding:1em;border-radius: 100%;"><img src="cid:logoimg" style="margin: auto; height: 5em; width: auto;"></div></div>
                <h1 style="margin: auto; text-align: center;">Kedves ' . $name . '</h1>
                <hr>
                <p>A webshopba történő regisztrációd sikeres, hogy ne maradj le az újdonságoktól iratkozz fel a hírlevelemre is. A törölni szeretnéd a fiókodat az alábbi gomb segítségével ezt megteheted. </p>
                <br>
                <div style="margin: auto;text-align: center;"><a href="http://localhost:8000/unSubscribe?email=' . urlencode($address) . '&name=' . urlencode($name) . '" style="background-color: #3F4E4F; color: white;padding: 10px; border-radius: 10px; text-decoration: none;">Fiók törlése</a></div>
                </div> 
            ';

        return $this->mailHelper($address, $name, "Sikeres regisztráció", $body);
    }
    private function mailHelper($address, $name, $subject, $body, $addImg = null){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host =  env('MAIL_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = env('MAIL_PORT');
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('siposbalint0306@gmail.com', 'Sipos Bálint');
        $mail->addAddress($address, name: $name);
        $mail->isHTML(true);
        $mail->addEmbeddedImage(public_path('webp/Logó_email.jpg'), 'logoimg');

        if($addImg != null){
            $mail->addEmbeddedImage($addImg, 'blogImage');
        }

        $mail->Subject = $subject;
        $mail->Body = $body;

        try{
            $mail->send();
        }catch(\Exception $e){
            $mail->smtpClose();
            return redirect()->back()->with('error', 'Hiba az email elküldésekor');
        }
        
        $mail->smtpClose();
        return redirect()->back()->with('success', 'Email sikeresen elküldve');
    }
}
