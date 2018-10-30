<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $siteName;?></title>
    <script src="../../public/js/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>

<script src="../../public/js/jquery.min.js?_version=<?php echo $versionCode?>"></script>

<script src="../../public/js/im/zalyKey.js"></script>
<script src="../../public/js/im/zalyAction.js"></script>
<script src="../../public/js/im/zalyClient.js"></script>
<script src="../../public/js/im/zalyBaseWs.js"></script>

<script type="text/javascript">

     requestSiteConfig(handleLoginSiteConfig);
     function handleLoginSiteConfig(params)
     {
         ZalyIm(params);
         var pluginLoginProfileJsonStr = localStorage.getItem(siteLoginPluginKey);
         var pluginLoginProfile = JSON.parse(pluginLoginProfileJsonStr);
         var landingPageUrl = pluginLoginProfile.landingPageUrl;

         localStorage.clear();
         if(landingPageUrl.indexOf("?")) {
             landingPageUrl +="&from=duckchat&redirect_url="+encodeURIComponent(location.href);
         }else{
             landingPageUrl +="?from=duckchat&redirect_url="+encodeURIComponent(location.href);
         }
         window.location.href = landingPageUrl;
     }

</script>
</body>
</html>

