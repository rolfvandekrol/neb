<?php
//kpr(get_defined_vars());
?>

<?php print $messages; ?>

<div id="container" class="gc">
  <div id="container-inner" class="test clearfix">

    <div id="header">
      <div id="header-inner">
      
        <?php print render($page['header']); ?>

      </div>
    </div>
    <!--/header-->

    <div id="page">
      <div id="page-inner">

        <div id="pageheader">
          <?php print render($page['header_second']); ?>
        </div>
        <!-- /pagehheader-->
        
        <div id="pagebody">
          <div id="pagebody-inner" class="clearfix">
            
            <?php if($page['third_firstcolumn'] || $page['third_secondcolum'] || $page['third_thirdcolumn'] ): ?>
            <div class="main-3columns">
              <?php print render($page['third_firstcolumn']); ?> 
              <?php print render($page['third_secondcolum']); ?> 
              <?php print render($page['third_thirdcolumn']); ?> 
            </div>
            <?php endif; ?>            

            <?php if($page['half_first'] || $page['half_second'] ): ?>
            <div class="main-2columns">
              <?php print render($page['half_first']); ?>                 
              <?php print render($page['half_second']); ?>
            </div>                  
            <?php endif ?>


            <div id="main">
              <?php print render($page['sidebar_first']); ?>                   

              <div id="main-content">
                <?php print render($page['content_pre']); ?>                
                <?php print render($page['content']); ?>                
                <?php print render($page['content_post']); ?>                
              </div>
              <!--/main content-->            

              <?php print render($page['sidebar_second']); ?>                
            </div>
            <!--/main-->            
              
        </div></div>
        <!-- /pagebody-->

        <div id="pagefooter">
          <div id="pagefooter-inner" class="clearfix">
            <?php print render($page['footer_firstcolumn']); ?>
            <?php print render($page['footer_secondcolumn']); ?>
            <?php print render($page['footer_thirdcolumn']); ?>
            <?php print render($page['footer_fourthcolumn']); ?>
        </div></div>
        <!--/pagefooter-->


    </div></div>
    <!--/page-->

  </div>
  <!--/container-inner-->

  <div id="footer">
    <?php print render($page['footer']); ?>
  </div>

</div>
<!--/container-->
