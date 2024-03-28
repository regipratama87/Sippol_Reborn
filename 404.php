
<!DOCTYPE html>
<?php
		require('koneksi.php');
		$query = "SELECT title FROM configs";
		$result = mysqli_query($koneksi, $query);
		$row = mysqli_fetch_assoc($result);
		$title =  $row['title'];
		?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
  <title>404 - Not Found</title>
  <style>
    
:root {
  --blue: #293b49;
  --pink: #fdabaf;
  --pink-light: #ffe0e6;
  --green: #4e73df;
  --green-dark: #224abe;
  --white: white;
}

html,
body {
  margin: 0;
}

html {
  font-size: 62.5%;
}

body {
  font-family: "Nunito", sans-serif;
  font-size: 1.5rem;
  color: var(--blue);
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.dev/svgjs' width='2000' height='2000' preserveAspectRatio='none' viewBox='0 0 2000 2000'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1082%26quot%3b)' fill='none'%3e%3cuse xlink:href='%23SvgjsSymbol1089' x='0' y='0'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsSymbol1089' x='0' y='720'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsSymbol1089' x='0' y='1440'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsSymbol1089' x='720' y='0'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsSymbol1089' x='720' y='720'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsSymbol1089' x='720' y='1440'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsSymbol1089' x='1440' y='0'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsSymbol1089' x='1440' y='720'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsSymbol1089' x='1440' y='1440'%3e%3c/use%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1082'%3e%3crect width='2000' height='2000' fill='white'%3e%3c/rect%3e%3c/mask%3e%3cpath d='M-1 0 a1 1 0 1 0 2 0 a1 1 0 1 0 -2 0z' id='SvgjsPath1087'%3e%3c/path%3e%3cpath d='M-3 0 a3 3 0 1 0 6 0 a3 3 0 1 0 -6 0z' id='SvgjsPath1083'%3e%3c/path%3e%3cpath d='M-5 0 a5 5 0 1 0 10 0 a5 5 0 1 0 -10 0z' id='SvgjsPath1086'%3e%3c/path%3e%3cpath d='M2 -2 L-2 2z' id='SvgjsPath1084'%3e%3c/path%3e%3cpath d='M6 -6 L-6 6z' id='SvgjsPath1085'%3e%3c/path%3e%3cpath d='M30 -30 L-30 30z' id='SvgjsPath1088'%3e%3c/path%3e%3c/defs%3e%3csymbol id='SvgjsSymbol1089'%3e%3cuse xlink:href='%23SvgjsPath1083' x='30' y='30' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='30' y='90' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='30' y='150' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='30' y='210' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='30' y='270' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='30' y='330' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='30' y='390' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='30' y='450' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='30' y='510' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='30' y='570' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='30' y='630' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='30' y='690' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='90' y='30' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='90' y='90' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='90' y='150' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='90' y='210' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='90' y='270' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='90' y='330' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='90' y='390' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='90' y='450' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='90' y='510' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='90' y='570' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='90' y='630' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='90' y='690' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='150' y='30' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='150' y='90' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='150' y='150' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='150' y='210' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='150' y='270' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='150' y='330' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='150' y='390' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='150' y='450' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='150' y='510' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='150' y='570' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='150' y='630' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='150' y='690' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1087' x='210' y='30' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='210' y='90' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1088' x='210' y='150' stroke='rgba(0%2c 0%2c 0%2c 0.08)' stroke-width='3'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='210' y='210' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='210' y='270' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='210' y='330' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1087' x='210' y='390' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='210' y='450' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='210' y='510' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='210' y='570' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='210' y='630' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='210' y='690' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='270' y='30' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='270' y='90' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='270' y='150' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='270' y='210' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='270' y='270' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='270' y='330' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='270' y='390' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='270' y='450' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='270' y='510' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='270' y='570' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='270' y='630' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='270' y='690' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='330' y='30' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='330' y='90' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='330' y='150' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='330' y='210' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='330' y='270' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='330' y='330' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='330' y='390' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='330' y='450' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='330' y='510' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='330' y='570' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='330' y='630' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='330' y='690' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='390' y='30' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1087' x='390' y='90' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='390' y='150' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='390' y='210' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='390' y='270' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='390' y='330' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='390' y='390' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='390' y='450' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='390' y='510' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='390' y='570' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='390' y='630' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1087' x='390' y='690' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='450' y='30' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='450' y='90' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='450' y='150' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='450' y='210' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='450' y='270' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1088' x='450' y='330' stroke='rgba(0%2c 0%2c 0%2c 0.08)' stroke-width='3'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='450' y='390' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='450' y='450' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='450' y='510' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='450' y='570' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='450' y='630' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='450' y='690' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='510' y='30' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='510' y='90' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='510' y='150' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='510' y='210' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='510' y='270' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='510' y='330' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='510' y='390' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='510' y='450' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='510' y='510' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1087' x='510' y='570' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='510' y='630' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='510' y='690' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='570' y='30' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='570' y='90' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='570' y='150' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='570' y='210' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='570' y='270' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='570' y='330' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='570' y='390' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='570' y='450' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='570' y='510' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='570' y='570' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1088' x='570' y='630' stroke='rgba(0%2c 0%2c 0%2c 0.08)' stroke-width='3'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='570' y='690' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='630' y='30' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='630' y='90' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='630' y='150' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='630' y='210' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='630' y='270' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='630' y='330' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='630' y='390' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='630' y='450' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='630' y='510' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='630' y='570' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='630' y='630' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='630' y='690' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='690' y='30' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='690' y='90' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='690' y='150' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='690' y='210' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='690' y='270' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='690' y='330' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1086' x='690' y='390' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1084' x='690' y='450' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1088' x='690' y='510' stroke='rgba(0%2c 0%2c 0%2c 0.08)' stroke-width='3'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='690' y='570' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1085' x='690' y='630' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3cuse xlink:href='%23SvgjsPath1083' x='690' y='690' stroke='rgba(0%2c 0%2c 0%2c 0.08)'%3e%3c/use%3e%3c/symbol%3e%3c/svg%3e");
  background-size: cover;
}

a {
  text-decoration: none;
}

.center {
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  margin: 12rem auto;
}

.error {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-content: center;
}

.number {
  font-weight: 900;
  font-size: 15rem;
  line-height: 1;
}

.illustration {
  position: relative;
  width: 12.2rem;
  margin: 0 2.1rem;
}

.circle {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 12.2rem;
  height: 11.4rem;
  border-radius: 50%;
  background-color: var(--blue);
}

.clip {
  position: absolute;
  bottom: 0.3rem;
  left: 50%;
  transform: translateX(-50%);
  overflow: hidden;
  width: 12.5rem;
  height: 13rem;
  border-radius: 0 0 50% 50%;
}

.paper {
  position: absolute;
  bottom: -0.3rem;
  left: 50%;
  transform: translateX(-50%);
  width: 9.2rem;
  height: 12.4rem;
  border: 0.3rem solid var(--blue);
  background-color: var(--white);
  border-radius: 0.8rem;
}

.paper::before {
  content: "";
  position: absolute;
  top: -0.7rem;
  right: -0.7rem;
  width: 1.4rem;
  height: 1rem;
  background-color: var(--white);
  border-bottom: 0.3rem solid var(--blue);
  transform: rotate(45deg);
}

.face {
  position: relative;
  margin-top: 2.3rem;
}

.eyes {
  position: absolute;
  top: 0;
  left: 2.4rem;
  width: 4.6rem;
  height: 0.8rem;
}

.eye {
  position: absolute;
  bottom: 0;
  width: 0.8rem;
  height: 0.8rem;
  border-radius: 50%;
  background-color: var(--blue);
  animation-name: eye;
  animation-duration: 2s;
  animation-iteration-count: infinite;
  animation-timing-function: ease-in-out;
}

.eye-left {
  left: 0;
}

.eye-right {
  right: 0;
}

@keyframes eye {
  0% {
    height: 0.8rem;
  }
  50% {
    height: 0.8rem;
  }
  52% {
    height: 0.1rem;
  }
  54% {
    height: 0.8rem;
  }
  100% {
    height: 0.8rem;
  }
}

.rosyCheeks {
  position: absolute;
  top: 1.6rem;
  width: 1rem;
  height: 0.2rem;
  border-radius: 50%;
  background-color: var(--pink);
}

.rosyCheeks-left {
  left: 1.4rem;
}

.rosyCheeks-right {
  right: 1.4rem;
}

.mouth {
  position: absolute;
  top: 3.1rem;
  left: 50%;
  width: 1.6rem;
  height: 0.2rem;
  border-radius: 0.1rem;
  transform: translateX(-50%);
  background-color: var(--blue);
}

.text {
  margin-top: 5rem;
  font-weight: 300;
  color: var(--blue);
}

.button {
  margin-top: 4rem;
  padding: 1.2rem 3rem;
  color: var(--white);
  background-color: var(--green);
}

.button:hover {
  background-color: var(--green-dark);
}

.by {
  position: absolute;
  bottom: 0.5rem;
  left: 0.5rem;
  text-transform: uppercase;
  color: var(--blue);
}

.byLink {
  color: var(--green);
}
.navbar {
    position: relative;
    padding: 0.1rem auto;
  background-color:#fff;
  color: var(--green)!important;
  border-bottom: 1px solid #e0e0e0;
}

.container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 1200px;
  margin: .5rem 1rem;
  padding: 0 0.375rem;
}

.navbar-brand {
  font-weight: bold;
  color: var(--green)!important;
  text-decoration: none;
  margin-left: 5rem;
}

.navbar-nav {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
}

.nav-item {
  margin-left: 1rem;
}

.nav-link {
  color: white;
  text-decoration: none;
}

.nav-link:hover {
  text-decoration: underline;
}
footer {
  position: fixed; /* Ubah menjadi fixed agar footer tetap terlihat di bagian bawah */
  bottom: 0; /* Tempatkan footer di bagian bawah */
  left: 0;
  width: 100%; /* Pastikan footer mengisi seluruh lebar halaman */
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1rem 1rem;
  background-color: #fff;
  color: var(--green)!important;
  border-top: 1px solid #e0e0e0;
  height: 100px; /* Anda dapat menyesuaikan tinggi footer sesuai kebutuhan */
}

</style>
</head>
<body>
<?php
// Mendapatkan path saat ini
$currentPath = $_SERVER['REQUEST_URI'];
$domain = $_SERVER['HTTP_HOST'];
if (stripos($currentPath, '/administrator') !== false) {
    // Jika path mengandung "/administrator", maka tautan akan mengarah ke /administrator/index.php
    $homePage = "https://$domain/administrator/index.php";
} else {
    // Jika tidak terdapat "/administrator", maka tautan akan mengarah ke index.php secara default
    $homePage = "https://$domain";
}

?>
  <nav class="navbar">
    <div class="container-fluid">
      <h3><a class="navbar-brand" href="index.php"><?php echo $title ?></a></h3>
    </div>
  </nav>

  <div class="center">
    <div class="error">
      <div class="number">4</div>
      <div class="illustration">
        <div class="circle"></div>
        <div class="clip">
          <div class="paper">
            <div class="face">
              <div class="eyes">
                <div class="eye eye-left"></div>
                <div class="eye eye-right"></div>
              </div>
              <div class="rosyCheeks rosyCheeks-left"></div>
              <div class="rosyCheeks rosyCheeks-right"></div>
              <div class="mouth"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="number">4</div>
    </div>

    <div class="text">Oops. halaman tidak ditemukan!</div>
    <a class="button" href="<?php echo $homePage; ?>">Homepage</a>
  </div>

  <footer>
					<div class="container my-auto">
						<div class="copyright my-auto" style="text-align: center;">
							<p>&copy; Dinas Komunikasi dan Informatika Kabupaten Kediri <br>
              <?php
								echo "<strong>".$row['title']."</strong>";
								mysqli_close($koneksi);
							?> <br>2024
              </p>
						</div>
					</div>
				</footer>
</body>
  </html>