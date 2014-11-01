<?php
class Utility {

    public function __construct() {
        
    }
 
    public static function prepareData($data) {
        global $db;
        return $db->real_escape_string($data);
    }
    
    public static function fixLineEndings($txt) {
        $txt = preg_replace('/\\\r\\\n/', "\n", $txt);
        return $txt;
    }

    /*
     * FORMAT STRINGS (phone#, email)
    */
    public static function format($type, $data) {
        switch ($type) {
            case 'phone':
                $phone[0] = substr($data, 0, 3);
                $phone[1] = substr($data, 3, 3);
                $phone[2] = substr($data, 6, 4);
                return implode('-', $phone);
                break;
            case 'email':
                break;
        }
    }

    public static function getFileExt($file) {     
        global $supported_media;
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        
        if (false === $ext = array_search($finfo->file($file),$supported_media,true)) {
            return false;
        } else {
            return $ext;
        }   
    }
    
    public static function getSetValues($params) {
        global $db;
        $values = array();

        $result = $db->query("SELECT $params[0], $params[1] FROM $params[2]");
        while ($temp = $result->fetch_object()) {
            $values[$temp->$params[0]] = $temp->$params[1];    
        }  
        
        return $values;  
    }
    
    public static function sanitizeData($data) {
        $data = preg_replace("/^\s*/", '', $data);
        
        $data = preg_replace("/[\^\#\$\*\@\`\~]/m", '', $data);
        
        return $data;
    }

    public static function sanitizeFilename($filename) {
        $filename = preg_replace("/^\s*/", '', $filename);
        
        $filename = preg_replace("/[\^\#\\\?\\$\&\*\%\@\!\`\~]/", '', $filename);
        
        $filename = preg_replace("/\s/", '-', $filename);
        
        return $filename;
    }

    public static function saveMediaFile($tmp, $custom_name, $type, $bid) {
        global $config;
        
        if (self::validateUploadFile($tmp, $type)) {
            $ext = self::getFileExt($tmp);
            $new_name = $custom_name . '.' . $ext;
            $new_file = $config['root_dir'] . $config['media_upload'] . $type . DSEP .  $bid . DSEP . $new_name;
            
            if (!is_dir($config['root_dir'] . $config['media_upload'] . $type . DSEP . $bid)) {
                mkdir($config['root_dir'] . $config['media_upload'] . $type . DSEP . $bid);
            } 

            if (move_uploaded_file($tmp, $new_file)) {
                chmod($new_file, 0664);
            } else {
                return false;
            }                          
        
            return array($new_file, $new_name);
            
        } else {
            return false;
        }
    }
    
    public static function validateUploadFile($file, $type) {
        
        // VERIFY FILE TYPE
        if (false === $ext = self::getFileExt($file)) {
            return false;
        }
        
        // VERIFY FILE SIZE
        if (filesize($file) > 2000000) {
            return false;
        }    
        
            
        return true;
        
    }

    public static function flattenArray($arr) {
        $newarr = array();
        
        foreach ($arr as $row) {
            foreach ($row as $k => $v) {
                $newarr[$k] = $v;    
            }
                
        }
        
        return $newarr;
    }
    

}
?>
