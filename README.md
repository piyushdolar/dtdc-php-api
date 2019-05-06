# dtdc-php-api
Dtdc php api for developers

# Tutorials Scenerio
1. Create/Register shippping to dtdc website via shipping.php file.
2. Track your awb by api via tracking.php file

1. Generate shipping.<br>
You will get response like below when successfully generated your file.<br>
For shipping response:<br>
RESPONSE:<br>
{
  status: "OK",
    data:  [
      {        
        success: true,        
        reference_number: "X42688401",
      }
    ]
  }
