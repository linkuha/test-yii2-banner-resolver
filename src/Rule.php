<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 13.09.2018
 * Time: 20:12
 */

namespace linkuha\BannerResolver;

use \yii\base\InvalidConfigException;

class Rule
{
    const RULE_REGION = "region";
    const RULE_PERCENTAGE = "percent";
    const RULE_PARAMETER = "param";

    /* @var string */
    public $type;
    public $key;
    public $value;
    public $return;
    public $children = [];

    /**
     * Rule constructor.
     *
     * @param $t string
     * @param $k string
     * @param $v string
     * @param $r string
     * @param $ch array
     * @throws \Exception
     */
    public function __construct($t, $k, $v, $r, $ch = [])
    {
        $this->type = $t;
        $this->key = $k;
        $this->value = $v;
        $this->return = $r;
        $this->children = $ch;

        $this->validate();
    }

    /**
     * Валидация правил
     * @throws \Exception
     */
    public function validate()
    {
        if ( ! isset($this->return) && $this->type !== self::RULE_REGION) {
            throw new InvalidConfigException("Necessary field 'return' is missed in banner rule: ");
        }
        if ( ! isset($this->type)) {
            throw new InvalidConfigException("Necessary field 'type' is missed in banner rule: ");
        }
        if ( ! isset($this->value)) {
            throw new InvalidConfigException("Necessary field 'value' is missed in banner rule: ");
        }

        switch ($this->type) {
            case Rule::RULE_PARAMETER:
                if (1 == preg_match("~[^\w]~iu", $this->key)) {
                    throw new InvalidConfigException("Banners config not correct (parameter key in rule)");
                }
                break;
            case Rule::RULE_REGION:
                if ( ! isset($this->return) && empty($this->children)) {
                    throw new InvalidConfigException("Banners config not correct (no children, so why no return?)");
                }
                if (mb_strlen($this->value) > 2) {
                    throw new InvalidConfigException("Banners config not correct (country code in rule)");
                }
                break;
            case Rule::RULE_PERCENTAGE:
                if (1 == preg_match("~[^\d]~iu", $this->value)) {
                    throw new InvalidConfigException("Banners config not correct (percentage in rule)");
                }
                break;
        }

        if (
            Rule::RULE_PERCENTAGE == $this->type &&
            count($this->children) > 0
        ) {
            throw new InvalidConfigException("Banners config not correct (percentage rule can't having child rules)");
        }
    }
}