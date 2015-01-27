<?php

class MessageController extends \BaseController
{
    public function getConversation($displayName)
    {
        $convId = Messages::getConversationIdByDisplayName($this->user->id, $displayName);

        if(! ($convId > 0))
            return Redirect::route('users.edit', [$this->user->id]);

        $conv = Messages::getMessages($this->user->id, $convId);

        // Flip list of messages so they read top to bottom.
        $messages = [];
        foreach ( $conv->getAllMessages() as $msg )
        {
            array_unshift($messages, $msg);
        }

        return View::make('v3.users.messages.conversation')
            ->with('user', $this->user)
            ->with('buddysDisplayName', $displayName)
            ->with('messages', $messages);
    }

    public function postMessage($displayName)
    {
        $body = Input::get('mail_body');

        $recipient = \User::where('display_name', $displayName)->first();

        Messages::sendMessageByDisplayName($this->user->id, $displayName, $body);

        event('user.message.reply', [
            'sender' => $this->user,
            'recipient' => $recipient,
            'body' => $body
        ]);

        return Redirect::route('conversation', [$displayName])->with('message', 'Message sent!');

    }

}