<!DOCTYPE html>

<html>
  <head>
    <title>Add Map</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style>
        /* Set the size of the div element that contains the map */
#map {
  height: 400px;
  /* The height is 400 pixels */
  width: 100%;
  /* The width is the width of the web page */
}
    </style>
  </head>
  <body>
    <h3 style="align-content: center;">Map showing clinics</h3>

     <form action="clinicPosition" method="post">

                    @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{Session::get('fail')}}
                    </div>
                    @endif

                    @csrf
                   <div class="form-group" >
                      
                     <select  name="district" class="form-control  rounded-0"  required>
                      <?php foreach ($districts as  $value):   ?>
                                        <option value="{{$value['id']}}" >{{$value['name']}} </option>
                                       
                                    <?php endforeach ?>
                        
                        <option selected value=''>Select district</option>
                     </select>
                     <span class="text-danger">@error('department'){{$message}} @enderror</span>
                   

                    
                      
                     <select  name="disease" class="form-control  rounded-0"  required>
                      
                        <?php foreach ($diseases as  $value):   ?>
                                        <option value="{{$value['id']}}" >{{$value['diseaseName']}} </option>
                                       
                                    <?php endforeach ?>
                        <option selected value=''>Select disease</option>
                     </select>
                     <span class="text-danger">@error('department'){{$message}} @enderror</span>
                    
                
                   <button type="submit" class="btn btn-block " style="background-color: green; color: white">Submit</button><br>
              </div>
                </form>

                <br><br><br><br>

    
    <div id="map"></div>

 
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSybt8ZMP8pRtDEfgZdrSce6JnhLs0rWY&callback=initMap&v=weekly"
      defer
    ></script>
    <script>

      var latitudePosition;
      var longitudePosition;
 

      const successCallback = (position)=>{
        
        latitudePosition = position.coords.latitude;
        longitudePosition = position.coords.longitude;
        
         initMap(latitudePosition,longitudePosition);
      };
 

      const errorCallback = (error)=> {
        console.error(error);
      };

      navigator.geolocation.getCurrentPosition(successCallback, errorCallback);

     // Initialize and add the map   
      

        function initMap(lat,lng) {

          var latitude =lat;
          var longitude = lng;
          var clinics = <?php  echo $pharmacies ?>;      
          


          // var latitude = -15.7762085;
          // var longitude = 35.0307656;
                   

         // const  Malawi = { lat: {{$latitude}}, lng: {{$longitude}} };


    


          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
            // center: Malawi,
            center:{
          lat: latitude,
          lng: longitude
        },
          });

                
          // const marker = new google.maps.Marker({
          //   position: Malawi,
          //   map: map,
          // });
          

             for (i = 0; i < clinics.length; i++) {
             // console.log(clinics[i].latitude);
             // console.log(clinics[i].longitude);
              marker = new google.maps.Marker({
                  position: new google.maps.LatLng(clinics[i].latitude, clinics[i].longitude),
                  map: map
              });

              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                  return function() {
                      infowindow.setContent(clinics[i].name);
                      infowindow.open(map, marker);
                  }
              })(marker, i));
             }

        }

        window.initMap = initMap;
    </script>
  </body>
</html>

