        // Open Street Map
        const place = {
                "Javoy Père & Fils": { "lat":47.83309, "lon":1.81769 },
        };
        
        //initialisation de la carte 
        const carte = L.map('maCarte').setView([47.83309, 1.81769], 11);
        
        // chargement des "tuiles"
        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            attribution: 'données <a href="//osm.org/copyright">OpenStreetMap</a>ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
            minzoom: 1,
            maxZoom: 20,
        }).addTo(carte);
    

        // création du marqueur et attribution d'un popup
        const marker = L.marker([47.83309, 1.81769]).addTo(carte);
        marker.bindPopup("<p><strong>Javoy Père & Fils</strong></p>");
      
  







