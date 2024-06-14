<section class="content">
	<div class="row">
		<div class="panel">
			<div class="panel-header" style="padding: 0.8em">
				<div class="row" style="margin-right: 1em">
					<div class="col-md-7">
						 
						
						<a href="#" id="btnCetakLaporanMonitoring" class="btn-sm btn-success"><i class="fa fa-print"></i> Export Excel</a>
						
						
					</div>
					<div class="col-md-2 col-xs-12 text-right" style="margin-top: 0.4em">
						<select id="bulan_unit" name="bulan" class="form-control" required>
							<option value="">Bulan..</option>
							<option <?php echo $f_bulan == 'setahun' ? 'selected' : '' ?> value="setahun">Setahun</option>
							<?php foreach ($bulan as $b): ?>
								<option <?php echo $f_bulan == $b->id_bulan ? 'selected' : '' ?>  value="<?php echo $b->id_bulan ?>"><?php echo $b->bulan ?></option>}
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-md-2 col-xs-12 text-right" style="margin-top: 0.4em">
						<select id="tahun_unit" name="bulan" class="form-control" required>
							<option value="">Tahun..</option>
							<?php foreach ($tahun as $t): ?>
								<option <?php echo $f_tahun == $t->tahun ? 'selected' : '' ?> value="<?php echo $t->tahun ?>"><?php echo $t->tahun ?></option>}
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-md-1 col-xs-12 text-right" style="margin-top: 0.4em">
						<button id="btn_filter_unit" class="btn bg-purple"><i class="fa fa-filter"></i> Filter</button>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover" style="font-size: 1.4rem;">
						<thead>
							<tr>
								<th class="text-center" width="10%">#</th>
								<th class="text-center" width="40%">Unit Pelayanan</th>
								<th class="text-center" width="20%">Jumlah Responden</th>
								<th class="text-center" width="30%">Index Kepuasan</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							foreach ($unit as $unit): ?>
								<tr>
									<td class="text-center"><?php echo $no++ ?></td>
									<td > <?php echo $unit['nama_unit'] ?>  
									</td>
									<td class="text-center"><?php echo $unit['responden'] != 0 ? $unit['responden'] : '-' ?></td>
									<td class="text-center" style="font-weight: bold;"><?php echo $unit['nilai'] != null ? number_format($unit['nilai'],2)."" : '-' ?> </td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
 

<script src="<?php echo base_url('assets/js/jsbaru/js_monitoring.js') ?>" type="text/javascript"></script>