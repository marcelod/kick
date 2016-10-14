<section class="content-header">
    <?php echo $pagetitle; ?>
    <?php echo $breadcrumb; ?>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-3">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h4 class="box-title">Draggable Events</h4>
        </div>
        <div class="box-body">
          <!-- the events -->
          <div id="external-events">
            <div class="external-event bg-green">Lunch</div>
            <div class="external-event bg-yellow">Go home</div>
            <div class="external-event bg-aqua">Do homework</div>
            <div class="external-event bg-light-blue">Work on UI design</div>
            <div class="external-event bg-red">Sleep tight</div>
            <div class="checkbox">
              <label for="drop-remove">
                <input type="checkbox" id="drop-remove">
                remove after drop
              </label>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Create Event</h3>
        </div>
        <div class="box-body">
          <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
            <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
            <ul class="fc-color-picker" id="color-chooser">
              <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
              <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
            </ul>
          </div>
          <!-- /btn-group -->
          <div class="input-group">
            <input id="new-event" type="text" class="form-control" placeholder="Event Title">

            <div class="input-group-btn">
              <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
            </div>
            <!-- /btn-group -->
          </div>
          <!-- /input-group -->
        </div>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-body no-padding">
          <!-- THE CALENDAR -->
          <div id="calendar"></div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->