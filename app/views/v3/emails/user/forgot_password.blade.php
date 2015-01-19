@extends('v3.emails.template')

@section('body')
    <p><strong>Password escaped you? No worries, it happens! Your new password is just a click away.</strong></p>
@stop
@section('extra')
    <table width="100%" height="auto" align="center" cellspacing="30" cellpadding="0" bgcolor="#ffffff">
        <tr>
            <td>
                <br>
                <br>
                <div class="text-center">
                    {{ Html::decode(Html::linkRoute('users.resetpassword', image('/assets/img/email/btns/btn_reset_password.png', 'Reset Password'), [$user->display_name, $resetCode], ['class' => 'btn btn-blue'])) }}
                </div>
                <div class="mb30">
                    <p>If you didn&apos;t request to reset your password, please ignore this email.  Nothing will change until you access the link above and create a new one.</p>
                </div>
            </td>
        </tr>
    </table>

@stop