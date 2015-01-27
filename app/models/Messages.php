<?php

class Messages
{

    public static function sendMessage($sender_id, $recipient_id, $body)
    {
        $convId = \TBMsg::getConversationByTwoUsers($sender_id, $recipient_id);

        if(! ($convId > 0))
            $convId = \TBMsg::createConversation([$sender_id, $recipient_id])->id;

        \TBMsg::addMessageToConversation($convId, $sender_id, $body);

    }

    /**
     * @param $currentUserId
     * @param $displayName
     * @return int conversation_id
     */
    public static function getConversationIdByDisplayName($currentUserId, $displayName)
    {
        return \TBMsg::getConversationByTwoUsers($currentUserId, User::getIdFromDisplayName($displayName));

    }

    /**
     * @param $convId
     * @param $userId
     * @return Tzookb\TBMsg\Entities\Conversation
     */
    public static function getMessages($currentUserId, $convId)
    {
        return \TBMsg::getConversationMessages($convId, $currentUserId);

    }

    public static function sendMessageByDisplayName($currentUserId, $displayName, $body)
    {
        $convId = Messages::getConversationIdByDisplayName($currentUserId, $displayName);

        static::sendMessage($currentUserId, User::getIdFromDisplayName($displayName), $body);
    }

    public static function unread($userId)
    {
        return TBMsg::getNumOfUnreadMsgs($userId);
    }
}