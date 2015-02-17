<?php


/**
 * Class PardotEmail
 */
class PardotEmail
{


    /**
     * @var
     */
    public $subject;
    /**
     * @var
     */
    public $content;
    /**
     * @var
     */
    public $from;
    /**
     * @var
     */
    public $fromName;
    /**
     * @var
     */
    public $plainText;


    /**
     * @param array $params
     */
    public function __construct($params = [])
    {
        $config = Config::get('mail.from');

        $this->from = $config['address'];
        $this->fromName = $config['name'];


        foreach ($params as $key => $val) {
            $this->{$key} = $val;
        }
    }
}