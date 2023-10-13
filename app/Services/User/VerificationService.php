<?php


namespace App\Services\User;


use App\Models\User;
use App\Models\User\VerificationModel;
use App\Services\Mail\RegisterMailService;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Boolean;

class VerificationService extends UserService implements VerificationInterface
{

  /**
   * send verification for user
   * @param $form
   * @param $user_id
   * @return bool
   */

  public function sendVerification($form, $user_id, RegisterMailService $registerMailService)
  {

    $user = $this->getUser($user_id);

    if ($user->verification === null) {

      $fileName = time() . '.' . $form->file('file')->getClientOriginalName();
      $form->file('file')->move(public_path('/storage/verification'), $fileName);

      VerificationModel::create([
        'user_id' => $user_id,
        'link' => $form->link,
        'file' => $fileName,
        'text' => $form->text,
        'isVerification' => 1,
      ]);

      $message = "<html><head></head><body><p>
                Подана заявка на верификацию<br>
                Имя: . $user->first_name<br>
                Фамилия: . $user->last_name<br>
                Телефон: . $user->phone<br>
                Email: . $user->email<br>
                Ссылка на админку: . <br>
                </p></body></html>";

      $registerMailService->sendMail("evon.information@gmail.com", $message);

      return true;

    } else {
      return false;
    }

  } //end

  /**
   * edit status for verification
   * @param $verification_id
   * @param $status
   */

  public function editStatus($verification_id, $status): void
  {
    $verification = VerificationModel::where('id', $verification_id)->first();

    $verification->status = $status;
    $verification->save();

    User::where('id', $verification->user_id)
      ->update([
        'verification' => 1
      ]);

  } //end
}
