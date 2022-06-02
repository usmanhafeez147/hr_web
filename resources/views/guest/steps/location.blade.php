<div class="container">
    <div class="form-group">
        <input placeholder="search company's location here..." class="form-control col-sm-4" type="text" id="searchmap" name="searchmap">
    </div>
    <div class="form-group">
        <div style="width:100%;height:300px;" id="map"></div>
    </div>
    <input  type="hidden" value="{{$cid}}" name="company_id">

    <div class="form-group">
        <label>
          Latitude:
        </label>
        <input class="form-control col-sm-4" required placeholder="Latitude" type="text" name="lat" id="lat">

    </div>

    <div class="form-group">
        <label>
          Longitude:
        </label>
        <input class="form-control col-sm-4" required placeholder="Latitude" type="text" name="lng" id="lng">
        
    </div>
</div>
