@foreach($constellations as $constellation)
	<h5>{{ $constellation->today_date }}</h5>
	<h5>{{ $constellation->constellation_name }}</h5>
	<h5>{{ $constellation->all_score }}</h5>
	<h5>{{ $constellation->all_description }}</h5>
	<h5>{{ $constellation->love_score}}</h5>
	<h5>{{ $constellation->love_description }}</h5>
	<h5>{{ $constellation->work_score}}</h5>
	<h5>{{ $constellation->work_description }}</h5>
	<h5>{{ $constellation->fortune_score}}</h5>
	<h5>{{ $constellation->fortune_description }}</h5>
@endforeach