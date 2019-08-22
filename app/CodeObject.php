<?php

namespace App\Core;


use DateTime;

/**
 * Class CodeObject
 * @package App\Core
 */
class CodeObject
{
    /**
     * @var
     */
    protected $code_title;

    /**
     * @var
     */
    protected $code_block;

    /**
     * @var
     */
    protected $code_section;

    /**
     * @var
     */
    protected $code_date;

    /**
     * @return mixed
     */
    public function getCodeTitle(): string
    {
        return $this->code_title;
    }

    /**
     * @return mixed
     */
    public function getCodeBlock(): string
    {
        return $this->code_block;
    }

    /**
     * @return mixed
     */
    public function getCodeSection(): string
    {
        return $this->code_section;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getCodeDate()
    {
        $date = new DateTime( '@'.$this->code_date );
        return $date->format('"F j Y"');
    }


}