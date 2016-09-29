<html>
<title>%%TITLE%%</title>
<head>
<script language=javascript>
function save_to_cart(form,name,cnt){
        var chk;
        var i;
        var sample_ids = '';
        if (cnt < 1) return;
        for (i=1;i<=cnt;i++)
                eval('if (form.'+name+'_'+i+'.checked == true) sample_ids = sample_ids + form.'+name+'_'+i+'.value+\',\';');
        form.sample_ids.value = sample_ids;
	form.submit();
}
</script>
</head>
<body>
<h2>Eukaryotic Comparative Epigenomics Platform v0.1</h2>
<table width=800 style='border:0px'>
<tr><td>
<h3>"Epigenome analysis web portal - make it easy"</h3>
</td><td><div align=right>
<a href='/epigenome/'><img src=/epigenome/img/home.png width=52></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='/epigenome/favorite/'><img src=/epigenome/img/cart_favorite.png width=48></a><a href='/epigenome/help.php'><img src=/epigenome/img/help.png width=110></a></div></td></tr></table>
