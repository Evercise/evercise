<?php

class Messages extends TBMsg
{

    public static function sendMessage($senderId, $receiverId, $content)
    {
/*        $convId = static::getConversationByTwoUsers($senderId, $receiverId);

        if(! ($convId > 0))
            $convId = static::createConversation([$senderId, $receiverId])->id;

        static::addMessageToConversation($convId, $senderId, $content);*/

        //Oh look this method already exists
        static::sendMessageBetweenTwoUsers($senderId, $receiverId, $content);

    }

    /**
     * @param $currentUserId
     * @param $displayName
     * @return int conversation_id
     */
    public static function getConversationIdByDisplayName($currentUserId, $displayName)
    {
        return static::getConversationByTwoUsers($currentUserId, User::getIdFromDisplayName($displayName));

    }

    /**
     * @param $convId
     * @param $userId
     * @return Tzookbstatic\Entities\Conversation
     */
    public static function getMessages($currentUserId, $convId)
    {
        return static::getConversationMessages($convId, $currentUserId);
    }

    public static function sendMessageByDisplayName($currentUserId, $displayName, $content)
    {
        $convId = Messages::getConversationIdByDisplayName($currentUserId, $displayName);

        static::sendMessage($currentUserId, User::getIdFromDisplayName($displayName), $content);
    }

    public static function unread($userId)
    {
        return static::getNumOfUnreadMsgs($userId);
    }

    public static function getLastMessageDisplayName($userId)
    {
        $convs = TBMsg::getUserConversations($userId);

        foreach ($convs as $conv) {
            foreach ($conv->getAllParticipants() as $p){
                if($p != $userId){
                    /** Return display_name of first conversation buddy found */
                    return User::where('id', $p)->pluck('display_name');
                }
            }
        }
        return '';
    }

    public static function markRead($userId, $convId)
    {
        static::markReadAllMessagesInConversation($convId, $userId);
    }

    public static function getConversations($userId)
    {
        $convs = TBMsg::getUserConversations($userId);

        $ids = [];
        foreach($convs as $conv){
            foreach ($conv->getAllParticipants() as $p) {
                if ($p != $userId) {
                    $ids[] = $p;
                }
            }
        }

        return User::whereIn('id', $ids)->lists('display_name');
    }

    public function unreadMessagesInConversation($userId, $convId)
    {
        /** TODO - Put a little number next to each conversation in the list */

        return 0;
    }
}