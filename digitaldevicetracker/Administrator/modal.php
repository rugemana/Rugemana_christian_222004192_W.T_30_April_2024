
<!-- Modal for adding new device -->
<div class="modal fade" id="addDeviceModal" tabindex="-1" role="dialog" aria-labelledby="addDeviceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDeviceModalLabel">Add New Device</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for adding new device -->
                <form action="server.php" method="POST">
                    <div class="form-group">
                        <label for="device_name">Device Name</label>
                        <input type="text" class="form-control" id="device_name" name="device_name" required>
                    </div>
                    <div class="form-group">
                        <label for="serial_number">Serial Number</label>
                        <input type="text" class="form-control" id="serial_number" name="serial_number" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="AddDevice" value="ok">Add Device</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Device Modal -->
<div class="modal fade" id="editDeviceModal<?php echo $device['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editDeviceModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editDeviceModalLabel">Edit Device</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form to edit device details -->
        <form method="post" action="server.pph">
          <div class="form-group">
            <label for="editDeviceName<?php echo $device['id']; ?>">Device Name</label>
            <input type="text" class="form-control" id="editDeviceName<?php echo $device['id']; ?>" name="edit_device_name" value="<?php echo $device['device_name']; ?>">
          </div>
          <div class="form-group">
            <label for="editDeviceSerial<?php echo $device['id']; ?>">Serial Number</label>
            <input type="text" class="form-control" id="editDeviceSerial<?php echo $device['id']; ?>" name="edit_device_serial" value="<?php echo $device['serial_number']; ?>">
          </div>
          <div class="form-group">
            <label for="editDeviceDescription<?php echo $device['id']; ?>">Description</label>
            <textarea class="form-control" id="editDeviceDescription<?php echo $device['id']; ?>" name="edit_device_description"><?php echo $device['description']; ?></textarea>
          </div>
          <input type="hidden" name="device_id" value="<?php echo $device['id']; ?>">
          <button type="button" class="btn btn-primary" name="updateDevice" value="ok">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Confirm Borrower's Request Modal -->
<div class="modal fade" id="confirmRequestBorrowModal<?php echo $device['transaction_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="confirmRequestBorrowModalLabel<?php echo $device['transaction_id']; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmRequestBorrowModalLabel<?php echo $device['transaction_id']; ?>">Confirm Borrower's Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to confirm this borrower's request?</p>
        <form id="confirmBorrowForm<?php echo $device['transaction_id']; ?>" action="server.php" method="POST">
          <input type="hidden" name="device_id" value="<?php echo $device['transaction_id']; ?>">
          <button type="submit" class="btn btn-primary" name="confirm_request_borrow">Confirm</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Cancel Borrower's Request Modal -->
<div class="modal fade" id="cancelRequestBorrowModal<?php echo $device['transaction_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="cancelRequestBorrowModalLabel<?php echo $device['transaction_id']; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelRequestBorrowModalLabel<?php echo $device['transaction_id']; ?>">Cancel Borrower's Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to cancel this borrower's request?</p>
        <form id="cancelBorrowForm<?php echo $device['transaction_id']; ?>" action="server.php" method="POST">
          <input type="hidden" name="device_id" value="<?php echo $device['transaction_id']; ?>">
          <button type="submit" class="btn btn-danger" name="cancel_request_borrow">Cancel Request</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Confirm Returned Borrow Modal -->
<div class="modal fade" id="confirmReturnedBorrowModal<?php echo $device['transaction_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="confirmReturnedBorrowModalLabel<?php echo $device['transaction_id']; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmReturnedBorrowModalLabel<?php echo $device['transaction_id']; ?>">Confirm Returned Borrow</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to confirm that this device has been returned?</p>
        <form id="confirmReturnedBorrowForm<?php echo $device['transaction_id']; ?>" action="server.php" method="POST">
          <input type="hidden" name="device_id" value="<?php echo $device['transaction_id']; ?>">
          <button type="submit" class="btn btn-primary" name="confirm_returned_borrow">Confirm</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>





