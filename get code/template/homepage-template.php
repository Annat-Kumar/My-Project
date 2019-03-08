<?php
/*Template Name: Home Page*/
get_header('header-childtheme');
?>
    <section class="top-banner" id="section1">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
                 <div class="banner">
				      <div class="banner-content">
					        <h2>RAQAM</h2>
							<button class="banner-btn">Learn More</button>
					  </div>
				 </div>
            </div>
          </div>
        </div>
    </section>
     <section class="about-us" id="section2">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
                 <div class="circle-img">
					<img src="<?php bloginfo('template_directory');?>/images/about.png">	
                 </div>
				 <div class="about-content">
						<?php $post = get_post('26');?>			 
                      <h2><?php echo $post->post_title  ; ?></h2>					  
					  <p><?php echo $post->post_content ;?></p>
					  <button class="get-in-btn">Get in Touch</button>
                 </div>
            </div>
          </div>
        </div>
    </section>
	<section class="services" id="section3">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                 <div class="service-out white-creame">				   
                        <!--<img src="<?php //bloginfo('template_directory');?>/images/1.png">	-->
						<!-- TradingView Widget BEGIN -->
						<div class="tradingview-widget-container">
						  <div class="tradingview-widget-container__widget"></div>
						  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/BITFINEX-BTCUSD/" rel="noopener" target="_blank"><span class="blue-text">BTCUSD Rates</span></a> by TradingView</div>
							  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
							  {
								"symbol": "BITFINEX:BTCUSD",
								"width": 350,
								"height": 220,
								"locale": "en",
								"dateRange": "1y",
								"colorTheme": "dark",
								"trendLineColor": "rgba(0, 0, 0, 1)",
								"underLineColor": "rgba(255, 255, 255)",
								"isTransparent": false,
								"autosize": false,
								"largeChartUrl": ""
							 }
							  </script>
						</div>
						<!-- TradingView Widget END -->
                				
                 </div>
            </div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-12">
                 <div class="service-out white-creame">
				     
					 <!-- TradingView Widget BEGIN -->
						<div class="tradingview-widget-container">
						  <div class="tradingview-widget-container__widget"></div>
						  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/BITFINEX-ETHUSD/" rel="noopener" target="_blank"><span class="blue-text">ETHUSD Rates</span></a> by TradingView</div>
							  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
							  {
							  "symbol": "BITFINEX:ETHUSD",
							  "width": 350,
							  "height": 220,
							  "locale": "en",
							  "dateRange": "1y",
							  "colorTheme": "dark",
							  "trendLineColor": "rgba(0, 0, 0, 1)",
							  "underLineColor": "rgb(255,255,255)",
							  "isTransparent": false,
							  "autosize": false,
							  "largeChartUrl": ""
							}
							  </script>
						</div>
					<!-- TradingView Widget END -->
                 </div>
            </div>
			
			<div class="col-lg- col-md-6 col-sm-6 col-12">
                 <div class="service-out white-creame">
				    <!-- TradingView Widget BEGIN -->
					<div class="tradingview-widget-container">
					  <div class="tradingview-widget-container__widget"></div>
					  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/NYSE-CGC/" rel="noopener" target="_blank"><span class="blue-text">CGC Quotes</span></a> by TradingView</div>
						  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
						  {
						  "symbol": "NYSE:CGC",
						  "width": 350,
						  "height": 220,
						  "locale": "en",
						  "dateRange": "1y",
						  "colorTheme": "dark",
						  "trendLineColor": "rgba(0, 0, 0, 1)",
						  "underLineColor": "rgba(255, 255, 255)",
						  "isTransparent": false,
						  "autosize": false,
						  "largeChartUrl": ""
						}
						  </script>
					</div>
					<!-- TradingView Widget END -->				
                 </div>
            </div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-12">
                 <div class="service-out white-creame">
				     <!-- TradingView Widget BEGIN -->
						<div class="tradingview-widget-container">
						  <div class="tradingview-widget-container__widget"></div>
						  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/AMEX-MJ/" rel="noopener" target="_blank"><span class="blue-text">MJ Quotes</span></a> by TradingView</div>
						  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
						  {
						  "symbol": "AMEX:MJ",
						  "width": 350,
						  "height": 220,
						  "locale": "en",
						  "dateRange": "1y",
						  "colorTheme": "dark",
						  "trendLineColor": "rgba(0, 0, 0, 1)",
						  "underLineColor": "rgba(255, 255, 255)",
						  "isTransparent": false,
						  "autosize": false,
						  "largeChartUrl": ""
						}
						  </script>
						</div>
						<!-- TradingView Widget END -->
                 </div>
            </div>
						<div class="col-md-12">
						<!-- TradingView Widget BEGIN -->
						<div class="tradingview-widget-container">
						  <div class="tradingview-widget-container__widget"></div>
						  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com" rel="noopener" target="_blank"><span class="blue-text">Financial Markets</span></a> by TradingView</div>
						  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
						  {
						  "symbols": [
							{
							  "title": "S&P 500",
							  "proName": "INDEX:SPX"
							},
							{
							  "title": "Shanghai Composite",
							  "proName": "INDEX:XLY0"
							},
							{
							  "title": "EUR/USD",
							  "proName": "FX_IDC:EURUSD"
							}
						  ],
						  "theme": "dark",
						  "isTransparent": false,
						  "displayMode": "adaptive",
						  "locale": "en"
						}
						  </script>
						</div>
						<!-- TradingView Widget END -->
						</div>
          </div>
        </div>
    </section>
	<section class="contact-form" id="section4">
        <div class="container">
          <div class="row">
         
		  <div class="col-md-12 col-12 ">
		  	  <div class="contact-out">
			      <div class="contact-right">
                       <h2>CONTACT</h2>
                 </div>
                 <div class="contact-left ">
                       <div class="row">
					   <?php echo do_shortcode('[contact-form-7 id="28" title="Contact form 1"]');?>
					      
					   </div>
                 </div>
				 </div>
				 <div class="conatct-image">
				   <img src="<?php bloginfo('template_directory');?>/images/meeting.png">
				 </div>
            </div>
			 </div>
  
        </div>
    </section>
<?php 
get_footer('child');
?>