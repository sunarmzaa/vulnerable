<!-- Left side column. contains the sidebar-->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <!--<li class="header">MAIN NAVIGATION</li>-->
		<?php 
		  if($_SESSION["AUTHEN"]["ROLE"]=="DataEntry"){
		   			
			echo "<li>";
            echo "  <a href='vulnerable.management.php'>";
            echo "    <i class='fa fa-file'></i><span>ข้อมูลกลุ่มเปราะบาง</span>";
            echo "  </a>";
			echo "</li>";
			
			echo "<li>";
            echo "  <a href='vulnerable.form.php'>";
            echo "    <i class='fa fa-file'></i><span>แบบแจ้งข้อมูลผู้เปราะบาง</span>";
            echo "  </a>";
			echo "</li>";
			
		  }
      else if($_SESSION["AUTHEN"]["ROLE"]=="Admin"){
        echo "<li>";
              echo "  <a href='vulnerable.admin.management.php'>";
              echo "  <i class='fa fa-file'></i><span>ตรวจสอบข้อมูลกลุ่มเปราะบาง</span>";
              echo "  </a>";
        echo "</li>";
          //echo "<script type='text/javascript'>";
          //echo "<i class='fa fa-file'></i><span>ตรวจสอบข้อมูลกลุ่มเปราะบาง</span>";
        //echo "alert('ลบข้อมูลเรียบร้อยแล้ว');";
          //echo "window.location = 'vulnerable.management1.php'; ";

      // else{
      // echo "<li>";
      //       echo "  <a href='vulnerable.management1.php'>";
      //       echo "    <i class='fa fa-file'></i><span>ตรวจสอบข้อมูลกลุ่มเปราะบาง</span>";
      //       echo "  </a>";
			// echo "</li>";


      
			
			// echo "<li>";
      //       echo "  <a href='vulnerable.form.php'>";
      //       echo "    <i class='fa fa-file'></i><span>แบบแจ้งข้อมูลผู้เปราะบาง</span>";
      //       echo "  </a>";
			// echo "</li>";
        
      }
		?>
    </section>
    <!-- /.sidebar -->
  </aside>