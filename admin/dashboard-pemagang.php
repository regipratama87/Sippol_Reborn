<div class="row">
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-primary h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Jumlah Total</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                        require('../koneksi.php');
                        $query = "SELECT COUNT(DISTINCT id_user) AS total_user FROM user";
                        $result = mysqli_query($koneksi, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<p class='card-text'>" . $row['total_user'] . " Pemagang</p>";
                        mysqli_close($koneksi);
                        ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-success h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Sedang Magang</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                        require('../koneksi.php');
                        $query = "SELECT COUNT(*) AS sedang_magang FROM user WHERE status = 1";
                        $result = mysqli_query($koneksi, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<p class='card-text'>" . $row['sedang_magang'] . " Pemagang</p>";
                        mysqli_close($koneksi);
                        ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-info h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Selesai Magang</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                        require('../koneksi.php');
                        $query = "SELECT COUNT(*) AS selesai_magang FROM user WHERE status = 0";
                        $result = mysqli_query($koneksi, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<p class='card-text'>" . $row['selesai_magang'] . " Pemagang</p>";
                        mysqli_close($koneksi);
                        ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-danger  h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                        Tahun Ini (
                        <?php echo date("Y");?> )</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                                                require('../koneksi.php');
                                                $first_day_of_year = date("Y-01-01");
                                                $last_day_of_year = date("Y-12-31");
                                                
                                                $query = "SELECT COUNT(DISTINCT id_user) AS total_user FROM presensi WHERE data_tanggal BETWEEN '$first_day_of_year' AND '$last_day_of_year'";
                                                
                                                $result = mysqli_query($koneksi, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                echo "<p class='card-text'>" . $row['total_user'] . " Pemagang</p>";
                                                mysqli_close($koneksi);
                                            ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning  h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Bulan Ini  ( <?php  
                        $current_month_number = date('n');
                        $month_names_id = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                        $current_month_name = $month_names_id[$current_month_number];
                        echo strftime($current_month_name); 
                        ?> )
                    </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                                    require('../koneksi.php');
                                                    $first_day_of_month = date("Y-m-01");
                                                    $last_day_of_month = date("Y-m-t");

                                                    $query = "SELECT COUNT(DISTINCT id_user) AS total_user FROM presensi WHERE data_tanggal BETWEEN '$first_day_of_month' AND '$last_day_of_month'";

                                                    $result = mysqli_query($koneksi, $query);
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo "<p class='card-text'>" . $row['total_user'] . " Pemagang</p>";
                                                    mysqli_close($koneksi);
                                                ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-success  h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Minggu Ini</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                                                require('../koneksi.php');
                                                $today = date("Y-m-d");
                                                $start_of_week = date("Y-m-d", strtotime('monday this week', strtotime($today)));
                                                $end_of_week = date("Y-m-d", strtotime('sunday this week', strtotime($today)));
                                                $query = "SELECT COUNT(DISTINCT id_user) AS total_user FROM presensi WHERE data_tanggal BETWEEN '$start_of_week' AND '$end_of_week'";

                                                $result = mysqli_query($koneksi, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                echo "<p class='card-text'>" . $row['total_user'] . " Pemagang</p>";
                                                mysqli_close($koneksi);
                                            ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

</div>


<div class="row">
<div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-dark  h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                        Belum Presensi (Hari ini)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                        require('../koneksi.php');
                        $query = "SELECT COUNT(*) AS total_user_belum_presensi 
          FROM user 
          WHERE status = 1 
            AND id_user NOT IN (SELECT DISTINCT id_user 
                                FROM presensi 
                                WHERE DATE(data_tanggal) = CURDATE())";


                        $result = mysqli_query($koneksi, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<p class='card-text'>" . $row['total_user_belum_presensi'] . " Pemagang</p>";
                        mysqli_close($koneksi);
                        ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-info  h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Sudah Presensi (Hari ini)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                                    require('../koneksi.php');
                                                    $query = "SELECT COUNT(DISTINCT id_user) AS total_user 
          FROM presensi 
          WHERE DATE(data_tanggal) = CURDATE()";

                                                    $result = mysqli_query($koneksi, $query);
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo "<p class='card-text'>" . $row['total_user'] . " Pemagang</p>";
                                                    mysqli_close($koneksi);
                                                ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php
                            require('../koneksi.php');

                            $query = "SELECT COUNT(DISTINCT id_user) AS total_presensi, 
                 DATE_FORMAT(data_tanggal, '%Y-%m-%d') AS tanggal 
          FROM presensi 
          WHERE YEAR(data_tanggal) = YEAR(CURDATE()) 
            AND MONTH(data_tanggal) = MONTH(CURDATE())  
          GROUP BY DATE_FORMAT(data_tanggal, '%Y-%m-%d')";


                            $result = mysqli_query($koneksi, $query);

                            $presensi_data = array();
                            $max_presensi = 0;
                            $days_in_month = date('t');
                            $tanggal_1_month = range(1, $days_in_month);

                            foreach ($tanggal_1_month as $tanggal) {
                                $presensi_data[$tanggal] = 0;
                            }

                            while ($row = mysqli_fetch_assoc($result)) {
                                $tanggal = (int)date('j', strtotime($row['tanggal']));
                                $presensi_data[$tanggal] = $row['total_presensi'];

                                if ($row['total_presensi'] > $max_presensi) {
                                    $max_presensi = $row['total_presensi'];
                                }
                            }

                            $presensi_data_json = json_encode(array_values($presensi_data));

                            mysqli_close($koneksi);
                            ?>

    <div class="row">
        <div class="col-12">
            <div class="card  mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-success">Diagram (Bulan <?php  
                        $current_month_number = date('n');
                        $month_names_id = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                        $current_month_name = $month_names_id[$current_month_number];
                        echo strftime($current_month_name); 
                        ?>)</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="diagramHarian"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script>
            Chart.defaults.global.defaultFontFamily='Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';Chart.defaults.global.defaultFontColor='#000';for(var currentDate=new Date,currentMonth=currentDate.getMonth(),currentYear=currentDate.getFullYear(),daysInMonth=new Date(currentYear,currentMonth+1,0).getDate(),labels2=[],i=1;i<=daysInMonth;i++)labels2.push(i.toString());function number_format(number,decimals,dec_point,thousands_sep){number=(number+'').replace(',', '').replace(' ', '');var n=!isFinite(+number)?0:+number,prec=!isFinite(+decimals)?0:Math.abs(decimals),sep=(typeof thousands_sep==='undefined')?',':thousands_sep,dec=(typeof dec_point==='undefined')?'.':dec_point,s='',toFixedFix=function(n,prec){var k=Math.pow(10,prec);return''+Math.round(n*k)/k;};s=(prec?toFixedFix(n,prec):''+Math.round(n)).split('.');if(s[0].length>3){s[0]=s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);}if((s[1]||'').length<prec){s[1]=s[1]||'';s[1]+=new Array(prec-s[1].length+1).join('0');}return s.join(dec);}var maxT=<?php echo $max_presensi;?>;var presensiData=<?php echo $presensi_data_json?>;var labels=[];var dataPresensi=[];presensiData.forEach(function(item){labels.push(item.data_tanggal);dataPresensi.push(item.total_presensi);});console.log(maxT);console.log(presensiData);var ctx=document.getElementById("diagramHarian");var myLineChart=new Chart(ctx,{type:'line',data:{labels:labels2,datasets:[{label:"Jumlah",lineTension:0,backgroundColor:"rgba(78, 115, 223, 0.05)",borderColor:"#1cc88a",pointRadius:1,pointBackgroundColor:"#1cc88a",pointBorderColor:"#1cc88a",pointHoverRadius:3,pointHoverBackgroundColor:"#1cc88a",pointHoverBorderColor:"#1cc88a",pointHitRadius:10,pointBorderWidth:4,data:presensiData,}],},options:{maintainAspectRatio:false,layout:{padding:{left:10,right:25,top:25,bottom:0}},scales:{xAxes:[{time:{unit:'date'},gridLines:{display:true,drawBorder:false},ticks:{maxTicksLimit:99}}],yAxes:[{ticks:{maxTicksLimit:maxT,padding:10,callback:function(value,index,values){return''+number_format(value);}},gridLines:{color:"rgb(234, 236, 244)",zeroLineColor:"rgb(234, 236, 244)",drawBorder:false,borderDash:[10],zeroLineBorderDash:[20]}}],},legend:{display:true},tooltips:{backgroundColor:"rgb(255,255,255)",bodyFontColor:"#858796",titleMarginBottom:10,titleFontColor:'#6e707e',titleFontSize:14,borderColor:'#dddfeb',borderWidth:1,xPadding:15,yPadding:15,displayColors:false,intersect:false,mode:'index',caretPadding:10,callbacks:{label:function(tooltipItem,chart){var datasetLabel=chart.datasets[tooltipItem.datasetIndex].label||'';return datasetLabel+': '+number_format(tooltipItem.yLabel)+' Pemagang';}}}}});
        </script>

        <?php
                            require('../koneksi.php');
                            $query = "SELECT COUNT(DISTINCT id_user) AS total_presensi, 
                            DATE_FORMAT(data_tanggal, '%Y-%m') AS tanggal 
                     FROM presensi 
                     WHERE YEAR(data_tanggal) = YEAR(CURDATE())  
                     GROUP BY DATE_FORMAT(data_tanggal, '%Y-%m')";
           
          
                            $result = mysqli_query($koneksi, $query);

$presensi_data = array();
$max_presensi = 0; 

$bulan_array = range(1, 12);

foreach ($bulan_array as $bulan) {
    $presensi_data[$bulan] = 0;
}

while ($row = mysqli_fetch_assoc($result)) {
    $bulan = (int)date('n', strtotime($row['tanggal']));
    
    $presensi_data[$bulan] = $row['total_presensi'];

    if ($row['total_presensi'] > $max_presensi) {
        $max_presensi = $row['total_presensi'];
    }
}

$presensi_data_json = json_encode(array_values($presensi_data));

mysqli_close($koneksi);
?>
            <div class="col-12">
                <div class="card  mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Diagram (Tahun <?php echo date("Y");?>)</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                Chart.defaults.global.defaultFontFamily='Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';Chart.defaults.global.defaultFontColor='#858796';function number_format(number,decimals,dec_point,thousands_sep){number=(number+'').replace(',', '').replace(' ', '');var n=!isFinite(+number)?0:+number,prec=!isFinite(+decimals)?0:Math.abs(decimals),sep=(typeof thousands_sep==='undefined')?',':thousands_sep,dec=(typeof dec_point==='undefined')?'.':dec_point,s='',toFixedFix=function(n,prec){var k=Math.pow(10,prec);return''+Math.round(n*k)/k;};s=(prec?toFixedFix(n,prec):''+Math.round(n)).split('.');if(s[0].length>3){s[0]=s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);}if((s[1]||'').length<prec){s[1]=s[1]||'';s[1]+=new Array(prec-s[1].length+1).join('0');}return s.join(dec);}var maxT=<?php echo $max_presensi;?>;var presensiData=<?php echo $presensi_data_json?>;var labels=[];var dataPresensi=[];presensiData.forEach(function(item){labels.push(item.data_tanggal);dataPresensi.push(item.total_presensi);});console.log(maxT);console.log(presensiData);var ctx=document.getElementById("myAreaChart");var myLineChart=new Chart(ctx,{type:'line',data:{labels:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],datasets:[{label:"Jumlah",lineTension:0,backgroundColor:"rgba(78, 115, 223, 0.05)",borderColor:"rgba(78, 115, 223, 1)",pointRadius:1,pointBackgroundColor:"rgba(78, 115, 223, 1)",pointBorderColor:"rgba(78, 115, 223, 1)",pointHoverRadius:3,pointHoverBackgroundColor:"rgba(78, 115, 223, 1)",pointHoverBorderColor:"rgba(78, 115, 223, 1)",pointHitRadius:10,pointBorderWidth:4,data:presensiData,}],},options:{maintainAspectRatio:false,layout:{padding:{left:10,right:25,top:25,bottom:0}},scales:{xAxes:[{time:{unit:'date'},gridLines:{display:true,drawBorder:false},ticks:{maxTicksLimit:12}}],yAxes:[{ticks:{maxTicksLimit:maxT,padding:10,callback:function(value,index,values){return''+number_format(value);}},gridLines:{color:"rgb(234, 236, 244)",zeroLineColor:"rgb(234, 236, 244)",drawBorder:false,borderDash:[10],zeroLineBorderDash:[20]}}],},legend:{display:true},tooltips:{backgroundColor:"rgb(255,255,255)",bodyFontColor:"#858796",titleMarginBottom:10,titleFontColor:'#6e707e',titleFontSize:14,borderColor:'#dddfeb',borderWidth:1,xPadding:15,yPadding:15,displayColors:false,intersect:false,mode:'index',caretPadding:10,callbacks:{label:function(tooltipItem,chart){var datasetLabel=chart.datasets[tooltipItem.datasetIndex].label||'';return datasetLabel+': '+number_format(tooltipItem.yLabel)+' Pemagang';}}}}});

            </script>
   <?php
require('../koneksi.php');

$current_year = date('Y');
$years = range($current_year, $current_year - 4);
$pemagang_tahunan = array_fill_keys($years, 0);
$query = "SELECT COUNT(*) AS total_pemagang, YEAR(mulai_magang) AS tahun_mulai_magang 
          FROM user 
          GROUP BY YEAR(mulai_magang)";
$result = mysqli_query($koneksi, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $tahun_mulai_magang = $row['tahun_mulai_magang'];
    $pemagang_tahunan[$tahun_mulai_magang] = $row['total_pemagang'];
}

$pemagang_tahunan_json = json_encode(array_values($pemagang_tahunan));

mysqli_close($koneksi);
?>
<div class="col-12">
    <div class="card  mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-danger">Diagram Total</h6>
        </div>
        <div class="card-body">
            <div class="chart-area">
                <canvas id="diagramSemuaPemagang"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';Chart.defaults.global.defaultFontColor = '#858796';var pemagangData = <?php echo $pemagang_tahunan_json; ?>.reverse();var labelsTahun = <?php echo json_encode(array_keys($pemagang_tahunan)); ?>.reverse();var ctx = document.getElementById("diagramSemuaPemagang");var myLineChart = new Chart(ctx,{type:'line',data:{labels:labelsTahun,datasets:[{label:"Jumlah Pemagang",lineTension:0,backgroundColor:"rgba(78, 115, 223, 0.05)",borderColor:"#e74a3b",pointRadius:3,pointBackgroundColor:"#e74a3b",pointBorderColor:"#e74a3b",pointHoverRadius:5,pointHoverBackgroundColor:"#e74a3b",pointHoverBorderColor:"#e74a3b",pointHitRadius:10,pointBorderWidth:2,data:Object.values(pemagangData),}],},options:{maintainAspectRatio:false,layout:{padding:{left:10,right:25,top:25,bottom:0}},scales:{xAxes:[{gridLines:{display:false}}],yAxes:[{ticks:{beginAtZero:true}}],},legend:{display:true},tooltips:{backgroundColor:"rgb(255,255,255)",bodyFontColor:"#858796",titleMarginBottom:10,titleFontColor:'#6e707e',titleFontSize:14,borderColor:'#dddfeb',borderWidth:1,xPadding:15,yPadding:15,displayColors:false,intersect:false,mode:'index',caretPadding:10,callbacks:{label:function(tooltipItem,chart){var datasetLabel=chart.datasets[tooltipItem.datasetIndex].label||'';return datasetLabel+': '+tooltipItem.yLabel+' Pemagang';}}}}});

</script>
</div>
