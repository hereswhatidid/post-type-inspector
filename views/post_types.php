<div class="wrap"
	ng-app="ptiApp">
	<h2><?php _e( 'Post Types', $this->slug ); ?></h2>
	<div class="bootstrap-wrapper"
	     ng-controller="PostTypesCtrl">
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-hover">
					<thead>
						<tr>
							<th><?php _e( 'Name', $this->slug ); ?></th>
							<th><?php _e( 'Slug', $this->slug ); ?></th>
							<th><?php _e( 'Source', $this->slug ); ?></th>
							<th><?php _e( 'Status', $this->slug ); ?></th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<tr
							ng-repeat="postType in postTypes">
							<td>{{postType.label}}</td>
							<td>{{postType.post_type}}</td>
							<td><a ng-href="{{postType.source.pluginUrl}}" target="_blank">{{postType.source.pluginTitle}}</a> - v{{postType.source.pluginVersion}}</td>
							<td></td>
							<td>
								<div class="btn-group btn-group-sm">
									<button type="button" class="btn btn-info"><?php _e( 'View', $this->slug ); ?></button>
									<button type="button" class="btn btn-success"><?php _e( 'Edit', $this->slug ); ?></button>
									<button type="button" class="btn btn-danger"><?php _e( 'Disable', $this->slug ); ?></button>
									<button type="button" class="btn btn-danger"><?php _e( 'Delete', $this->slug ); ?></button>
								</div>
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th><?php _e( 'Name', $this->slug ); ?></th>
							<th><?php _e( 'Slug', $this->slug ); ?></th>
							<th><?php _e( 'Source', $this->slug ); ?></th>
							<th><?php _e( 'Status', $this->slug ); ?></th>
							<th>&nbsp;</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
