
<!-- Request Borrow Modal with Date Picker -->
<div class="modal fade" id="requestBorrowModal<?php echo $device['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="requestBorrowModalLabel<?php echo $device['id']; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="requestBorrowModalLabel<?php echo $device['id']; ?>">Request to Borrow</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="server.php">
          <input type="hidden" name="device_id" value="<?php echo $device['id']; ?>">
          <div class="form-group">
            <label for="device_name">Device Name</label>
            <input type="text" class="form-control" id="device_name" name="device_name" value="<?php echo $device['device_name']; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="borrower_reason">Reason for Borrowing</label>
            <textarea class="form-control" id="borrower_reason" name="borrower_reason" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label for="return_date">Return Date</label>
            <input type="date" class="form-control" id="return_date" name="return_date" required>
          </div>
          <button type="submit" class="btn btn-primary" name="requestBorrow" value="ok">Submit Request</button>
        </form>
      </div>
    </div>
  </div>
</div>





