<?php

class security {


    public static function sanitizeInput($inputP)
    {
        $spaceDelimiter = '#BLANKSPACE#';
        $newLineDelimiter = '#NEWLNE#';

        $inputArray = [];
        $sanitizedInput = [];

        if($inputP === null) {
            return null;
        }
        if($inputP === false) {
            return false;
        }
        if(is_array($inputP) && count($inputP) <= 0) {
            return [];
        }

        if(is_array($inputP))
        {
            $inputArray = $inputP;
            $returnType = 'array';
        }
        else
        {
            $inputArray[] = $inputP;
            $returnType = 'string';
        }

        foreach($inputArray as $input)
        {
            $minified = str_replace(array(' ', "\n"), array($spaceDelimiter, $newLineDelimiter), $input);

            //removing <script> tags
            $minifiedSanitized = preg_replace('/[<][^<]*script.*[>].*[<].*[\/].*script*[>]/i',"",$minified);

            $unMinifiedSanitized = str_replace(array($spaceDelimiter, $newLineDelimiter), array(" ", "\n"), $minifiedSanitized);

            //removing inline js events
            $unMinifiedSanitized = preg_replace("/([ ]on[a-zA-Z0-9_-]{1,}=\".*\")|([ ]on[a-zA-Z0-9_-]{1,}='.*')|([ ]on[a-zA-Z0-9_-]{1,}=.*[.].*)/", '',$unMinifiedSanitized);

            //removing inline js
            $unMinifiedSanitized = preg_replace("/([ ]href.*=\".*javascript:.*\")|([ ]href.*='.*javascript:.*')|([ ]href.*=.*javascript:.*)/i", '',$unMinifiedSanitized);


            $sanitizedInput[] = $unMinifiedSanitized;
        }

        if($returnType === 'string' && count($sanitizedInput) > 0)
        {
            $returnData = $sanitizedInput[0];
        }
        else
        {
            $returnData = $sanitizedInput;
        }

        return $returnData;
    }
}
