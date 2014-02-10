<!-- Coordinates -->
<fieldset id='map-coordinates'>
    <form>
        <p>Coordonnées de départ du rover:</p>
        <label>X: </label>
        <input type="text" size="3px" id="startX" />
        <label>Y: </label>
        <input type="text" size="3px" id="startY" />

        <p>Destination du rover:</p>
        <label>X: </label>
        <input type="text" size="3px" id="endX"/>
        <label>Y: </label>
        <input type="text" size="3px" id="endY"/>

        <br />
        <span id='fields-rover-error'></span>
        <br />
        <input type="submit" value="Valider"/>
    </form>
</fieldset>

<!-- Dashboard -->
<div id="game-dashboard">
    <div id="energy">Energie: <span>0</span></div>
    <div id="round">Nombre de tours: <span>0</span></div>
</div>

<!-- Canvas -->
<canvas id="canvas"></canvas>

<!-- Console -->
<div id="console">
    <h3>Console</h3>
</div>

<!-- Bouton de loading -->
<div class="modal"></div>