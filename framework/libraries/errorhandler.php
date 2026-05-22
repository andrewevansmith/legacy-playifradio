<?php

class ErrorHandler extends Singleton
{
    public function show_error($type="", $description="")
    {
        // Generic message if in production systems
        if (($type=="") || (ENVIRONMENT != "DEVELOPMENT"))
        {
            $type = "An error has occurred";
            $description = "Please contact your server administrator.";
        }
        // blank parameters for generic error 
        $data['error_type'] = $type;
        $data['description'] = $description;
		if (is_array($data)) extract($data);
        echo "<h2>". $type . "</h2>";
        echo $description;
        //include('app/admin/views/error.php');
        die();
    }
    
}
