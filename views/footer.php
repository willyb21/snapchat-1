    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
	<?php if (Session::get('auth') == true): ?>
	<?php endif;?>

    <?php 
    if(!empty($this->script))
        echo $this->script;
    ?>

	 <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-46382407-1', 'snapchat.am');
	  ga('send', 'pageview');

	</script>
    <script type="text/javascript">
    var sc_project=9533909; 
    var sc_invisible=1; 
    var sc_security="fb8354d6"; 
    var scJsHost = (("https:" == document.location.protocol) ?
    "https://secure." : "http://www.");
    document.write("<sc"+"ript type='text/javascript' src='" +
    scJsHost+
    "statcounter.com/counter/counter.js'></"+"script>");
    </script>
    <noscript><div class="statcounter"><a title="web statistics"
    href="http://statcounter.com/free-web-stats/"
    target="_blank"><img class="statcounter"
    src="http://c.statcounter.com/9533909/0/fb8354d6/1/"
    alt="web statistics"></a></div></noscript>
    <script>
    (function ($) {

  // Log all jQuery AJAX requests to Google Analytics
  $(document).ajaxSend(function(event, xhr, settings){ 
    if (typeof _gaq !== "undefined" && _gaq !== null) {
      _gaq.push(['_trackPageview', settings.url]);
    }
  });

})(jQuery);
</script>
  </body>
</html>