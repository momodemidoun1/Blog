<?php

namespace Core\HTML;

class Form
{
    /**
     * @var array Données utilisée par le formulaire
    */
    private $data;

    /**
     *@var string Tag utilisé pour entourer les champs
     */
    public $surround = 'p';

    /**
     * __construct
     * @param  array $data
     */
    public function __construct($data = array())
    {
        $this->data = $data;
    }

    /**
     * surround
     * @param  string $html Code HTML a entourer
     * @return string
     */
    protected function surround (string $html): string
    {
        return "<{$this->surround}> {$html} </{$this->surround}>";
    }

    /**
     * getValue
     * @param  string $index Index de la valeur a recupérer
     * @return string | null
     */
    public function getValue (string $index): ?string
    {
        if (is_object($this->data)) {
            return $this->data->$index;
        }
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    /**
     * input
     * @param string $name
     * @param string $label
     * @param array $options
     * @return string
     */
    public function input (string $name, string $label, array $options = []): string
    {
        $type = isset($options['type']) ? $options['type'] : 'text';
        return $this->surround('<input type = "' . $type . '" name="'. $name .'" value ="' . $this->getValue($name) . '">');
    }

    /**
     * submit
     * @return string
     */
    public function submit (): string
    {
        return $this->surround('<button type="submit"> Envoyer </button>');
    }
}