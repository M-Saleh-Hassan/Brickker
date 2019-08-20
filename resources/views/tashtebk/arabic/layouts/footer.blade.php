<!--<div id="footer">-->
	<footer >
		<div class="foot-top">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<!--<h4>سياسة المعلومات</h4>-->
						<ul class="list-unstyled">
							<li><a href="{{route('ar.policy.index')}}">سياسة الخصوصية</a></li>
							<li><a href="{{route('ar.term.index')}}">بنود الخدمة</a></li>
						</ul>
					</div>
					<div class="col-md-4">
						<!--<h4>الشركة</h4>-->
						<ul class="list-unstyled">
                            <li><a href="{{route('ar.about.index')}}">عن الشركة</a></li>
                            <li><a href="{{route('ar.howtowork.index')}}">كيف تعمل</a></li>

						</ul>
					</div>
					<div class="col-md-4">
						<!--<h4>المساعدة</h4>-->
						<ul class="list-unstyled">
							<li><a href="{{route('ar.faq.index')}}">الأسئلة الشائعة</a> </li>
							<li><a href="{{route('ar.contactus.index')}}">تواصل معنا</a></li>


						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="foot-mid">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<ul>
							@if($setting->fb_show == 1)
								<li><a href="https://{{$setting->fb}}" class="fa fa-facebook"></a></li>
							@endif
							@if($setting->twitter_show == 1)
								<li><a href="https://{{$setting->twitter}}" class="fa fa-twitter"></a></li>
							@endif
							@if($setting->youtube_show == 1)
								<li><a href="https://{{$setting->youtube}}" class="fa fa-youtube"></a></li>
							@endif
							@if($setting->insta_show == 1)
								<li><a href="https://{{$setting->insta}}" class="fa fa-instagram"></a></li>
							@endif
							<li>/ Brickker</li>
						</ul>

					</div>
					<div class="col-md-6 text-center hidden">
						<div  class="phone">
							<i class="fa fa-phone"></i>
							{{$setting->mobile1}} - {{$setting->mobile2}}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="foot-bottom">
			<div class="container">
				<div class="row">
					<div class="copyright text-center">
						<p>
							All rights reserved <a href="{{route('en.home.index')}}" class="current-year">Brickker</a> © Copyrights 2019, Designed & Developed by <a href="https://www.logic-designs.com/" class="current-year">Logic Designs</a> .
						</p>
					</div>
				</div>
			</div>
	</footer>
<!--</div>-->
