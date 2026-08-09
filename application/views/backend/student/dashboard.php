<style>
/* Colorful dashboard cards, matching the site-editor / mobile menu look */
.stat-tile {
  border-radius: 10px !important;
  box-shadow: 0 1px 3px rgba(0,0,0,.08) !important;
  border-top: 4px solid var(--accent, #2563eb) !important;
  transition: transform .12s ease, box-shadow .12s ease !important;
  overflow: hidden;
}
.stat-tile:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 16px rgba(0,0,0,.12) !important;
}
.stat-tile .bodystate h4 {
  color: var(--accent, #1e293b);
  font-weight: 700;
}
.stat-tile .r-icon-stats i {
  box-shadow: 0 3px 8px rgba(0,0,0,.15);
}
.stat-c1 { --accent: #2563eb; }
.stat-c2 { --accent: #7c3aed; }
.stat-c3 { --accent: #db2777; }
.stat-c4 { --accent: #ea580c; }
.stat-c5 { --accent: #16a34a; }
.stat-c6 { --accent: #0891b2; }
.stat-c7 { --accent: #ca8a04; }
.stat-c8 { --accent: #dc2626; }

.panel-card {
  border-radius: 10px !important;
  box-shadow: 0 1px 3px rgba(0,0,0,.08) !important;
  border-top: 4px solid var(--accent, #2563eb) !important;
  overflow: hidden;
}
.panel-c1 { --accent: #7c3aed; }
.panel-c2 { --accent: #0891b2; }
.panel-c3 { --accent: #2563eb; }
.panel-c4 { --accent: #db2777; }

.panel-card .box-title {
  color: var(--accent, #1e293b);
}
.panel-card .table thead tr {
  background: var(--accent, #2563eb);
}
.panel-card .table thead th {
  color: #fff !important;
  border: none !important;
  font-weight: 600;
}
.panel-card .table tbody tr:hover {
  background: rgba(0,0,0,.025);
}
</style>

 <!--row -->
 <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box stat-tile stat-c1">
                            <div class="r-icon-stats">
                                <i class="ti-user bg-megna"></i>
                                <div class="bodystate">
                                    <h4><?php echo $this->db->count_all_results('student');?></h4>
                                    <span class="text-muted"><?php echo get_phrase('Students');?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box stat-tile stat-c2">
                            <div class="r-icon-stats">
                                <i class="ti-user bg-info"></i>
                                <div class="bodystate">
                                    <h4><?php echo $this->db->count_all_results('teacher');?></h4>
                                    <span class="text-muted"><?php echo get_phrase('Teachers');?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box stat-tile stat-c3">
                            <div class="r-icon-stats">
                                <i class="ti-user bg-success"></i>
                                <div class="bodystate">
                                    <h4><?php echo $this->db->count_all_results('parent');?></h4>
                                    <span class="text-muted"><?php echo get_phrase('parents');?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box stat-tile stat-c4">
                            <div class="r-icon-stats">
                                <i class="ti-wallet bg-inverse"></i>
                                <div class="bodystate">
                                    <h4>
                                    <?php 

                                    $check_daily_attendance = array('date' => date('Y-m-d'), 'status' => '1');
                                    $get_attendance_information = $this->db->get_where('attendance', $check_daily_attendance, 'student_id', $this->session->userdata('student_id'));
                                    $display_attendance_here = $get_attendance_information->num_rows();
                                    echo $display_attendance_here;
                                    ?>
                                    
                                    </h4>
                                    <span class="text-muted"><?php echo get_phrase('Download Area');?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box stat-tile stat-c5">
                            <div class="r-icon-stats">
                                 <i class="ti-wallet bg-inverse"></i>
                                <div class="bodystate">
                                    <h4><a href="news_letter.docx">News Letter</a></h4>
                                    <span class="text-muted"><a href="news_letter.docx"><?php echo get_phrase('Download');?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box stat-tile stat-c6">
                            <div class="">
                                 <i class=""></i>
                                <div class="bodystate">
                                    <h4><a href="SCHOOL FEES JSS.pdf">School Fees for JSS Classes</a></h4>
                                    <span class="text-muted"><a href="SCHOOL FEES JSS.pdf"><?php echo get_phrase('Download');?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box stat-tile stat-c7">
                            <div class="">
                                 <i class=""></i>
                                <div class="bodystate">
                                    <h4><a href="SCHOOL FEES PRY.pdf">School Fees for Primary Classes</a></h4>
                                    <span class="text-muted"><a href="SCHOOL FEES PRY.pdf"><?php echo get_phrase('Download');?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="white-box stat-tile stat-c8">
                            <div class="">
                                 <i class="">News Letter from the School Admin</i>
                                <div class="bodystate">
                                    <h4><a href="SCHOOL FEES PRY.pdf">School Fees for Primary Classes</a></h4>
                                    <span class="text-muted"><a href="SCHOOL FEES PRY.pdf"><?php echo get_phrase('Download');?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    

               
          
                <!--/row -->
                <!-- .row -->
               
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="white-box panel-card panel-c1">
                            <div class="stats-row">
                                

                        <style>
                        #chartdiv {
                        width: 100%;
                        height: 500px;
                        }

                        .amcharts-chart-div a{
                            display:none !important;
                        }	

                        </style>

              

                        <!-- Chart code -->
                        <script>
                        am4core.ready(function() {

                        // Themes begin
                        am4core.useTheme(am4themes_animated);
                        // Themes end

                        /**
                        * Chart design taken from Samsung health app
                        */

                        var chart = am4core.create("chartdiv", am4charts.XYChart);
                        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

                        chart.paddingBottom = 30;

                        chart.data = [
                
                        <?php $select_student = $this->db->get_where('invoice', array('year' => $running_year, 'student_id' => $this->session->userdata('student_id')))->result_array(); //$this->crud_model->get_invoice_info();
                            foreach ($select_student as $key => $student_selected):?>
                            
                            {
                            "name": "<?php echo $this->crud_model->get_type_name_by_id('student', $student_selected['student_id']);?>",
                            "steps": <?php echo $student_selected['amount_paid'];?>,
                            "href": "<?php echo base_url();?>uploads/student_image/<?php echo $student_selected['student_id']. '.jpg';?>"
                            }, 
                        <?php endforeach;?>
                        
                        ];

                        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                        categoryAxis.dataFields.category = "name";
                        categoryAxis.renderer.grid.template.strokeOpacity = 0;
                        categoryAxis.renderer.minGridDistance = 10;
                        categoryAxis.renderer.labels.template.dy = 35;
                        categoryAxis.renderer.tooltip.dy = 35;

                        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                        valueAxis.renderer.inside = true;
                        valueAxis.renderer.labels.template.fillOpacity = 0.3;
                        valueAxis.renderer.grid.template.strokeOpacity = 0;
                        valueAxis.min = 0;
                        valueAxis.cursorTooltipEnabled = false;
                        valueAxis.renderer.baseGrid.strokeOpacity = 0;

                        var series = chart.series.push(new am4charts.ColumnSeries);
                        series.dataFields.valueY = "steps";
                        series.dataFields.categoryX = "name";
                        series.tooltipText = "{valueY.value}";
                        series.tooltip.pointerOrientation = "vertical";
                        series.tooltip.dy = - 6;
                        series.columnsContainer.zIndex = 100;

                        var columnTemplate = series.columns.template;
                        columnTemplate.width = am4core.percent(50);
                        columnTemplate.maxWidth = 66;
                        columnTemplate.column.cornerRadius(60, 60, 10, 10);
                        columnTemplate.strokeOpacity = 0;

                        series.heatRules.push({ target: columnTemplate, property: "fill", dataField: "valueY", min: am4core.color("#e5dc36"), max: am4core.color("#5faa46") });
                        series.mainContainer.mask = undefined;

                        var cursor = new am4charts.XYCursor();
                        chart.cursor = cursor;
                        cursor.lineX.disabled = true;
                        cursor.lineY.disabled = true;
                        cursor.behavior = "none";

                        var bullet = columnTemplate.createChild(am4charts.CircleBullet);
                        bullet.circle.radius = 30;
                        bullet.valign = "bottom";
                        bullet.align = "center";
                        bullet.isMeasured = true;
                        bullet.mouseEnabled = false;
                        bullet.verticalCenter = "bottom";
                        bullet.interactionsEnabled = false;

                        var hoverState = bullet.states.create("hover");
                        var outlineCircle = bullet.createChild(am4core.Circle);
                        outlineCircle.adapter.add("radius", function (radius, target) {
                            var circleBullet = target.parent;
                            return circleBullet.circle.pixelRadius + 10;
                        })

                        var image = bullet.createChild(am4core.Image);
                        image.width = 60;
                        image.height = 60;
                        image.horizontalCenter = "middle";
                        image.verticalCenter = "middle";
                        image.propertyFields.href = "href";

                        image.adapter.add("mask", function (mask, target) {
                            var circleBullet = target.parent;
                            return circleBullet.circle;
                        })

                        var previousBullet;
                        chart.cursor.events.on("cursorpositionchanged", function (event) {
                            var dataItem = series.tooltipDataItem;

                            if (dataItem.column) {
                                var bullet = dataItem.column.children.getIndex(1);

                                if (previousBullet && previousBullet != bullet) {
                                    previousBullet.isHover = false;
                                }

                                if (previousBullet != bullet) {

                                    var hs = bullet.states.getKey("hover");
                                    hs.properties.dy = -bullet.parent.pixelHeight + 30;
                                    bullet.isHover = true;

                                    previousBullet = bullet;
                                }
                            }
                        })

                        }); // end am4core.ready()
                        </script>

                        <!-- HTML -->
                        <div id="chartdiv"></div>


                            </div>
                        </div>
                    </div>
</div>