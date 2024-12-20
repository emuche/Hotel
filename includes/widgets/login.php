
			<div class="modal fade" id="loginpopup">
			<div class="modal-dialog">
				<div class="modal-content">

					<!--header-->
					<div class="modal-header">
						<button  type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title">Log In</h3>
					</div>


					<!--body (form)-->
					<div class="modal-body">
						<form role="form" action="login.php" method="post">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Username" name="username">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" placeholder="Password" name="password">
							</div>
							<div class="form-group">
							<select class="form-control" name="department" required>
								<option value="" disabled selected > Department*</option>
								<option value="reception">Reception</option>
								<option value="bar">Bar</option>
								<option value="laundry">Laundry</option>
								<option value="store">Store</option>
								<option value="kitchen">Kitchen</option>
								<option value="admin">Admin</option>
							</select>
						</div>
						
					</div>



						<!--button-->
						<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-block">Log In</button>
							
						</div>
					</form>
				</div>
			</div>
		</div>