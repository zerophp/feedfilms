<?php

class Default_Model_Weather {
    public function getWeather($cityName, $language) {
        $forec = array();

        $requestAddress = 'http://www.google.com/ig/api?weather=' . $cityName . '&hl=' . $language;
        // Downloads weather data based on location
        $xml_str = utf8_encode(file_get_contents($requestAddress,0));

        //Zend_Debug::dump($xml_str, "Weather forecast XML_str", true);
        // Parses XML
        $xml = new SimplexmlElement($xml_str);
//        echo "<pre>";
//        print_r($xml);
//        echo "</pre>";die();
        //Zend_Debug::dump($xml, "Weather forecast XML", false);
        // Loops XML
        $count = 0;
        foreach($xml->weather as $item) {
//            foreach($item->current_conditions as $new) {
//                $forec[$count]['icon'] = 'http://www.google.com' . $new->icon['data'];
//                $forec[$count]['temp_c'] = '' . $new->temp_c['data'];
//                $forec[$count]['temp_f'] = '' . $new->temp_f['data'];
//                $forec[$count]['condition'] = '' . $new->condition['data'];
//                $forec[$count]['dayOfWeek'] = '' . $new->day_of_week['data'];
//                $count++;
//            }
            foreach($item->forecast_conditions as $new) {
                foreach($new as $day) {
                    $forec[$count]['icon'] = 'http://www.google.com' . $new->icon['data'];
                    $forec[$count]['low_f'] = '' . $new->low['data'];
                    $forec[$count]['high_f'] = '' . $new->high['data'];
                    $forec[$count]['low_c'] = '' . $new->low['data'];
                    $forec[$count]['high_c'] = '' . $new->high['data'];
                    $forec[$count]['condition'] = '' . $new->condition['data'];
                    $forec[$count]['dayOfWeek'] = '' . $new->day_of_week['data'];
                    $forec[$count]['degreeSymbol'] = ($language == 'en' ? 'ºF' : 'ºC');
                }
                $count++;
            }
        }
        Zend_Debug::dump($forec, "Weather forecast array", false);
        return $forec;
    }

//    private function FahrenheitToCelsius($f, $language) {
//        if ($language != 'en')
//            return number_format(($f - 32)/1.8, 0);
//        else
//            return $f;
//    }
}