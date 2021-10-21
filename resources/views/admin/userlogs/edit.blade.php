<div class="card card-bordered">
     <div class="card-inner">
        @if($currentUserInfo)
            <h4>IP: {{ $currentUserInfo->ip }}</h4>
            <h4>Country Name: {{ $currentUserInfo->countryName }}</h4>
            <h4>Country Code: {{ $currentUserInfo->countryCode }}</h4>
            <h4>Region Code: {{ $currentUserInfo->regionCode }}</h4>
            <h4>Region Name: {{ $currentUserInfo->regionName }}</h4>
            <h4>City Name: {{ $currentUserInfo->cityName }}</h4>
            <h4>Zip Code: {{ $currentUserInfo->zipCode }}</h4>
            <h4>Latitude: {{ $currentUserInfo->latitude }}</h4>
            <h4>Longitude: {{ $currentUserInfo->longitude }}</h4>
            <h4>view Map: <a href="https://www.google.com/maps/dir/{{ $currentUserInfo->latitude }},{{ $currentUserInfo->longitude }}" target="_blank">Clic to view</a> </h4>
        @else
        <h4>Location not found.</h4>
        @endif
    </div>
</div>