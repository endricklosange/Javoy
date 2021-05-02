        // Open Street Map
        const places = {
                "Javoy Père & Fils": { "lat":47.83309, "lon":1.81769 },
                "Château de Chambord": { "lat":47.616, "lon":1.517 },
                "Orléans": { "lat":47.902, "lon":1.908 }
        };
        //initialisation de la carte 
        const carte = L.map('maCarte').setView([47.83309, 1.81769], 11);
        
        // chargement des "tuiles"
        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            attribution: 'données <a href="//osm.org/copyright">OpenStreetMap</a>ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
            minzoom: 1,
            maxZoom: 20,
        }).addTo(carte);
        
        //on parcourt les différentes villes
        for(place in places){
            // création du marqueur et attribution d'un popup
            const marker = L.marker([places[place].lat, places[place].lon])
            .addTo(carte);
            marker.bindPopup("<p><strong>"+place+"</strong></p>");
        }
  







