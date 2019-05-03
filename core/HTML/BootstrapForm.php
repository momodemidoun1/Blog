<?php

namespace Core\HTML;


class BootstrapForm extends Form
{
    /**
     * surround
     * @param  string $html Code HTML a entourer
     * @return string
     */
    protected function surround (string $html): string {
        return "<div class=\"form-group\"> {$html} </div>";
    }

    /**
     * input render a Bootstrap input type
     * @param string $name
     * @param string $label
     * @param array $options different input types (ex: textarea , password etc ...)
     * @return string
     */
    public function input (string $name, string $label, array $options = []): string
    {
        $label = '<label>' . $label .'</label>';
        $type = isset($options['type']) ? $options['type'] : 'text';
        
        if ($type === 'textarea') {
            $input = '<textarea class="form-control" name="'. $name .'">' . $this->getValue($name) . '</textarea>';
        }
        else {
            $input = '<input type = "' . $type . '" class="form-control" name="'. $name .'" value ="' . $this->getValue($name) . '">';
        }

        return $this->surround($label . $input);
    }

    /**
     * select render a bootstrap select tag
     * @param string $name
     * @param string $label
     * @param $options
     * @return string
     */
    public function select ($name, string $label, $options): string
    {
        $label = '<label>' . $label . '</label>';
        $input = '<select class="form-control" name="'. $name .'">';
        foreach($options as $k =>  $v) {
            $selected = '';
            if ($k == $this->getValue($name)) {
                $selected = 'selected';
            }
            $input .=  '<option value="'. $k .'" '. $selected . '>' . $v . '</option>';
        }
        $input .= '</select>';
        return $this->surround($label . $input);
    }

}