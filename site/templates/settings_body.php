<div class="col-sm-9 main">
    <div class="page-header text-right">
        <h3>Account info</h3>
    </div>
    <form class="form-horizontal">
        <div id="post-message"></div>
        <div class="form-group">
            
            <label class="control-label col-xs-4">Handle:</label>
            <div class="col-xs-8" style="padding-right: 20%;">
                <?php
                    echo "<input type='text' class='form-control' name='handle' selected='true' disabled='disabled' placeholder='". $_SESSION['handle'] . "'>";
                ?>
                <div class="info">
                    What makes you different than everyone else?
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-4">University:</label>
            <div class="col-xs-8" style="padding-right: 20%;">
                <select class="chooseUni form-control" name="university">
                    <?php
                        $connection = new PDOConnection();
                        $connection->query('SELECT * FROM universities');
                        $schools = $connection->allResults();
                        
                        foreach($schools as &$school)
                        {
                             if($school['university_id'] == $_SESSION["university_id"])
                             {
                                 echo "<option value='" . $school['university_id'] . "' selected='selected'>" . $school['Name'] . "</option>";
                             }
                             else
                             {
                                 echo "<option value='" . $school['university_id'] . "'>" . $school['Name'] . "</option>";
                             }
                        }
                    ?>
                </select>
                <div class="info">
                    Where do you call home?
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-4">Notifications:</label>
            <div class="col-xs-8">
                <div class="radio">
                  <?php
                      if($_SESSION['notifications'] == 0)
                      {
                  ?>
                          <label><input type="radio" name="notifs" value="1">Yes</label>
                          <label><input type="radio" name="notifs" checked="checked" value="off">No</label>
                  <?php
                      }
                      else
                      {
                  ?>
                          <label><input type="radio" name="notifs" checked="checked" value="0">Yes</label>
                          <label><input type="radio" name="notifs" value="off">No</label>
                  <?php    
                      }
                  ?>
                </div>
                <div class="info">
                    Do you want to stay connected?
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-4">Top user recording:</label>
            <div class="col-xs-8">
                <div class="radio">
                  <?php
                      if($_SESSION["topUser"] == 0)
                      {
                  ?>
                          <label><input type="radio" name="topuser" value="1">Yes</label>
                          <label><input type="radio" name="topuser" checked="checked" value="0">No</label>
                  <?php
                      }
                      else
                      {
                  ?>
                          <label><input type="radio" name="topuser" checked="checked" value="1">Yes</label>
                          <label><input type="radio" name="topuser" value="0">No</label>
                  <?php    
                      }
                  ?>
                </div>
                <div class="info">
                    Do you want to brag?
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-4">Post with handle:</label>
            <div class="col-xs-8">
                <div class="radio">
                  <?php
                      if($_SESSION["anonymous"] == 1)
                      {
                  ?>
                          <label><input type="radio" name="anon" checked="checked" value="1">Yes</label>
                          <label><input type="radio" name="anon" value="0">No</label>
                  <?php
                      }
                      else
                      {
                  ?>
						  <label><input type="radio" name="anon" value="1">Yes</label>
						  <label><input type="radio" name="anon" checked="checked" value="0">No</label>
                  <?php    
                      }
                  ?>
                </div>
                <div class="info">
                    Do you want people to know who wrote that bomb post?
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-4 col-xs-offset-4">
                <button id="submit-post" type="button" class="form-control btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>