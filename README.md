# dtdc-php-api
Dtdc php api for developers

# Tutorials Scenerio
1. Create/Register shippping to dtdc website via shipping.php file.
2. Track your awb by following API.
  + http://ctbsplusapi.dtdc.com/dtdc-staging-api/api/dtdc/authenticate?username=M48_DEFAULT&password=password_DEFAULT

<br>SHIPPING.PHP
- You will get response like below when successfully generated your file.<br>
- For shipping response:<br>
- RESPONSE:<br>
{
  status: "OK",
    data:  [
      {        
        success: true,        
        reference_number: "X42688401",
      }
    ]
  }

