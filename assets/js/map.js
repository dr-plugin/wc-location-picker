addEventListener("DOMContentLoaded", showMap(event))

function showMap() {

    var marker;
    var myLockBtn = document.getElementById('myLocation');
    var saveBtn = document.getElementById('saveLocation');
    var cancelBtn = document.getElementById('cancel');

    if (cancelBtn !== null)
        cancelBtn.onclick = () => {
            var parent = window.frameElement.parentElement ?? false;
            if (parent)
                parent.classList.remove('show');
        }

    var map = L.map('jbMap').setView([35.6952, 51.4064], 10);

    map.scrollWheelZoom.disable();
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //    tileSize: 512,
        //     zoomOffset: -1,
        maxZoom: 19
    }).addTo(map);

    marker = new L.Marker([35.79235, 51.41647], {
        draggable: true
    });
    map.addLayer(marker);

    saveBtn.onclick = function () {
        var latLong = marker.getLatLng();
        //send message to parent
        window.parent.postMessage(latLong, "*");
    }

    map.on('click', function (e) {
        var newLatLng = new L.LatLng(e.latlng.lat, e.latlng.lng);
        //set marker
        marker.setLatLng(newLatLng);
    });

    myLockBtn.onclick = function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                var myLat = position.coords.latitude;
                var myLng = position.coords.longitude;

                newLatLng = new L.LatLng(myLat, myLng);
                marker.setLatLng(newLatLng);

                //set map view to marker
                map.setView([myLat, myLng]);
            });
        } else {
            //x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
}