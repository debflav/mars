<html>
    <head>
        <title>Mars app</title>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <script src="assets/js/three.min.js"></script>
        <script src="assets/js/jquery-2.0.3.min.js"></script>
        <script src="assets/js/stats.js"></script>
        <script>
            var map = <?php echo $oMap; ?>;
            var container, stats;
            var camera, scene, renderer;

            // DEBUG //
            console.log(map);
            for (var l = 0; l < map.lignes.length; l++) {
                for( var j = 0; j < map.lignes[l].length; j++ ) {
                    console.log("line number : " + l);
                    console.log(map.lignes[l][j]);
                }
            }
            // DEBUG //

            init();
            animate();

            function init() {

                    container = document.createElement( 'div' );
                    document.body.appendChild( container );

                    camera = new THREE.OrthographicCamera( window.innerWidth / - 2, window.innerWidth / 2, window.innerHeight / 2, window.innerHeight / - 2, - 500, 1000 );
                    camera.position.x = 200;
                    camera.position.y = 100;
                    camera.position.z = 200;

                    scene = new THREE.Scene();

                    // Grid

                    var size = 500, step = 50;

                    var geometry = new THREE.Geometry();

                    for ( var i = - size; i <= size; i += step ) {

                            geometry.vertices.push( new THREE.Vector3( - size, 0, i ) );
                            geometry.vertices.push( new THREE.Vector3(   size, 0, i ) );

                            geometry.vertices.push( new THREE.Vector3( i, 0, - size ) );
                            geometry.vertices.push( new THREE.Vector3( i, 0,   size ) );

                    }

                    var material = new THREE.LineBasicMaterial( { color: 0x000000, opacity: 0.2 } );

                    var line = new THREE.Line( geometry, material );
                    line.type = THREE.LinePieces;
                    scene.add( line );

                    // Cubes

                    var geometry = new THREE.CubeGeometry( 50, 50, 50 );
                    var material = new THREE.MeshLambertMaterial( { color: 0xffffff, shading: THREE.FlatShading, overdraw: 0.5 } );

                    for ( var i = 0; i < 100; i ++ ) {

                            var cube = new THREE.Mesh( geometry, material );

                            cube.scale.y = Math.floor( Math.random() * 2 + 1 );

                            cube.position.x = Math.floor( ( Math.random() * 1000 - 500 ) / 50 ) * 50 + 25;
                            cube.position.y = ( cube.scale.y * 50 ) / 2;
                            cube.position.z = Math.floor( ( Math.random() * 1000 - 500 ) / 50 ) * 50 + 25;

                            scene.add( cube );

                    }

                    // Lights

                    var ambientLight = new THREE.AmbientLight( Math.random() * 0x10 );
                    scene.add( ambientLight );

                    var directionalLight = new THREE.DirectionalLight( Math.random() * 0xffffff );
                    directionalLight.position.x = Math.random() - 0.5;
                    directionalLight.position.y = Math.random() - 0.5;
                    directionalLight.position.z = Math.random() - 0.5;
                    directionalLight.position.normalize();
                    scene.add( directionalLight );

                    var directionalLight = new THREE.DirectionalLight( Math.random() * 0xffffff );
                    directionalLight.position.x = Math.random() - 0.5;
                    directionalLight.position.y = Math.random() - 0.5;
                    directionalLight.position.z = Math.random() - 0.5;
                    directionalLight.position.normalize();
                    scene.add( directionalLight );

                    renderer = new THREE.CanvasRenderer();
                    renderer.setSize( window.innerWidth, window.innerHeight );

                    container.appendChild( renderer.domElement );

                    stats = new Stats();
                    stats.domElement.style.position = 'absolute';
                    stats.domElement.style.top = '0px';
                    container.appendChild( stats.domElement );

                    //

                    window.addEventListener( 'resize', onWindowResize, false );

            }

            function onWindowResize() {

                    camera.left = window.innerWidth / - 2;
                    camera.right = window.innerWidth / 2;
                    camera.top = window.innerHeight / 2;
                    camera.bottom = window.innerHeight / - 2;

                    camera.updateProjectionMatrix();

                    renderer.setSize( window.innerWidth, window.innerHeight );

            }

            //

            function animate() {

                    //requestAnimationFrame( animate );

                    render();
                stats.update();

            }

            function render() {

                    var timer = Date.now() * 0.0001;

                    camera.position.x = Math.cos( timer ) * 200;
                    camera.position.z = Math.sin( timer ) * 200;
                    camera.lookAt( scene.position );

                    renderer.render( scene, camera );

            }
        </script>
    </body>
</html>