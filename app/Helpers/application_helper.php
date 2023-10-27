<?php

/**
 * You can check query out put using this
 * echo $ci->db->last_query();
 */

if (!function_exists('DisplayStatus')) {

	function DisplayStatus($val)
	{
		$str = "";
		if ($val == 1) {
			$str = "<span class='badge badge-primary'>Active</span>";
		} else {
			$str = "<span class='badge badge-warning'>Inactive</span>";
		}
		return $str;
	} //end DisplayStatus function

} //end check DisplayStatus

if (!function_exists('PublishStatus')) {

	function PublishStatus($val)
	{
		$str = "";
		if ($val == 1) {
			$str = "<span class='badge badge-primary'>Publish</span>";
		} else {
			$str = "<span class='badge badge-danger'>Pending</span>";
		}
		return $str;
	} //end PublishStatus function

} //end check PublishStatus

if (!function_exists('ActiveStatus')) {

	function ActiveStatus($val)
	{
		$str = "";
		if ($val == 1) {
			$str = '<span class="badge badge-primary">Active</span>';
		} else if ($val == 2) {
			$str = '<span class="badge badge-danger">Reject</span>';
		} else {
			$str = '<span class="badge badge-warning">Inactive</span>';
		}
		return $str;
	} //end ActiveStatus function

} //end check ActiveStatus

if (!function_exists('DefaultStatus')) {

	function DefaultStatus($val)
	{
		$str = "";
		if ($val == 1) {
			$str = "<span class='badge badge-success'>Yes</span>";
		} else {
			$str = "<span class='badge badge-danger'>No</span>";
		}
		return $str;
	} //end PublishStatus function

} //end check PublishStatus

if (!function_exists('ArchiveStatus')) {

	function ArchiveStatus($val)
	{
		$str = "";
		if ($val == 1) {
			$str = '<span class="badge badge-primary">Yes</span>';
		} else {
			$str = '<span class="badge badge-danger">No</span>';
		}
		return $str;
	} //end ArchiveStatus function

} //end check ArchiveStatus

if (!function_exists('DeleteStatus')) {

	function DeleteStatus($val)
	{
		$str = "";
		if ($val == 1) {
			$str = '<span class="badge badge-danger">Yes</span>';
		} else {
			$str = '<span class="badge badge-primary">No</span>';
		}
		return $str;
	} //end DeleteStatus function

} //end check DeleteStatus

if (!function_exists('ReadStatus')) {

	function ReadStatus($val)
	{
		$str = "";
		if ($val == 1) {
			$str = '<span class="badge badge-success">Read</span>';
		} else {
			$str = '<span class="badge badge-warning">Unread</span>';
		}
		return $str;
	} //end ReadStatus function

} //end check ReadStatus

if (!function_exists('getUserType')) {

	function getUserType($val = 0)
	{
		$str = "";
		$val = (int)$val;
		if ($val == 1) {
			$str = 'Company User';
		} else if ($val == 2) {
			$str = 'Individual User';
		} else {
			$str = 'Implementing Partner';
		}
		return $str;
	} //end getUserType function

} //end check getUserType

if (!function_exists('getAdminType')) {

	function getAdminType($upm_id = 0, $dist_id = 0, $dept_id = 0)
	{

		$str = "";
		$upm_id = (int)$upm_id;
		$ci = &get_instance();

		if ($upm_id == 3) {

			$filter = array('department_id' => $dept_id, 'status' => 1);
			$query = $ci->db->select('department_name')->get_where('comm_departments', $filter);
			$row = $query->row();

			if (isset($row)) {
				$str = "Department User (" . $row->department_name . ")";
			} else {
				$str = "Department User";
			}
		} else if ($upm_id == 4) {

			$filter = array('district_code' => $dist_id);
			$query = $ci->db->select('district_name')->get_where('comm_district', $filter);

			$row = $query->row();

			if (isset($row)) {
				$str = "District User (" . $row->district_name . ")";
			} else {
				$str = "District User";
			}
		} else {
			$str = "Administrator";
		} //end check logged id

		return $str;
	} //end getAdminType function

} //end check getAdminType

if (!function_exists('InterestStatus')) {

	function InterestStatus($val = 0, $nameOnly = FALSE)
	{
		$str = "";
		if ($val == 1) {
			$strName = "Approved";
			$str = '<span class="badge badge-success">Approved</a>';
		} else {
			$strName = "Pending";
			$str = '<span class="badge badge-warning">Pending</a>';
		}

		if ($nameOnly == TRUE) {
			return $strName;
		} else {
			return $str;
		}
	} //end InterestStatus function

} //end check InterestStatus

if (!function_exists('InterestCount')) {

	function InterestCount($val = 0, $status, $project_id = 0)
	{
		$str = "";

		if ($val > 0) {
			$url = base_url("manage/Project/interestlist/") . encrypt_decrypt('encrypt', $project_id);
		} else {
			$url = "javascript:void(0);";
		}

		if ($status == 1) {
			$str = '<a target="_blank" href="' . $url . '" class="badge badge-primary">' . $val . '</a>';
		} else {
			$str = '<a href="' . $url . '" class="badge badge-warning">' . $val . '</a>';
		}

		return $str;
	} //end InterestCount function

} //end check InterestCount

if (!function_exists('ProjectStatus')) {

	function ProjectStatus($val = 0, $nameOnly = FALSE)
	{
		$str = "";
		$val = (int)$val;

		switch ($val) {
			case 1:
				$strName = "Approved";
				$str = '<span class="badge badge-success">' . $strName . '</span>';
				break;
			case 2:
				$strName = "Not Yet Started";
				$str = '<span class="badge badge-primary">' . $strName . '</span>';
				break;
			case 3:
				$strName = "Ongoing";
				$str = '<span class="badge badge-info">' . $strName . '</span>';
				break;
			case 4:
				$strName = "Completed";
				$str = '<span class="badge badge-success">' . $strName . '</span>';
				break;
			case 5:
				$strName = "On Hold";
				$str = '<span class="badge badge-danger">' . $strName . '</span>';
				break;

			default:
				$strName = "Pending";
				$str = '<span class="badge badge-warning">' . $strName . '</span>';
				break;
		}

		if ($nameOnly == TRUE) {
			return $strName;
		} else {
			return $str;
		}
	} //end ProjectStatus function

} //end check ProjectStatus

if (!function_exists('ProjectStatusList')) {

	function ProjectStatusList()
	{
		$project_status = array(
			'' => '--SELECT PROJECT STATUS--',
			'0' => 'Pending',
			'1' => 'Approved',
			'2' => 'Not Yet Started',
			'3' => 'Ongoing',
			'4' => 'Completed',
			'5' => 'On Hold'
		);

		return $project_status;
	} //end ProjectStatusList function

} //end check ProjectStatusList

if (!function_exists('ProjectDocStatus')) {

	function ProjectDocStatus($val = 0, $nameOnly = FALSE)
	{
		$str = "";
		$val = (int)$val;

		switch ($val) {
			case 1:
				$strName = 'Approved';
				$str = '<span class="badge badge-success">' . $strName . '</span>';
				break;
			case 2:
				$strName = 'Reject';
				$str = '<span class="badge badge-danger">' . $strName . '</span>';
				break;

			default:
				$strName = 'Pending';
				$str = '<span class="badge badge-warning">' . $strName . '</span>';
				break;
		}
		if ($nameOnly == TRUE) {
			return $strName;
		} else {
			return $str;
		}
	} //end ProjectDocStatus function

} //end check ProjectDocStatus

if (!function_exists('ProjectDocStatusList')) {

	function ProjectDocStatusList()
	{
		$project_status = array(
			'' => '--SELECT PROJECT STATUS--',
			'0' => 'Pending',
			'1' => 'Approved',
			'2' => 'Reject'
		);

		return $project_status;
	} //end ProjectDocStatusList function

} //end check ProjectDocStatusList

if (!function_exists('MilestoneStatus')) {

	function MilestoneStatus($val = 0, $nameOnly = FALSE)
	{
		$str = "";
		$val = (int)$val;

		switch ($val) {
			case 0:
				$strName = 'Not Started Yet';
				$str = '<span class="badge badge-primary">' . $strName . '</span>';
				break;
			case 1:
				$strName = 'Started';
				$str = '<span class="badge badge-info">' . $strName . '</span>';
				break;
			case 2:
				$strName = 'Completed';
				$str = '<span class="badge badge-success">' . $strName . '</span>';
				break;
			case 3:
				$strName = 'Reject';
				$str = '<span class="badge badge-danger">' . $strName . '</span>';
				break;
			case 4:
				$strName = 'Completed & Approved';
				$str = '<span class="badge badge-success">' . $strName . '</span>';
				break;

			default:
				$strName = 'Not Started Yet';
				$str = '<span class="badge badge-warning">' . $strName . '</span>';
				break;
		}
		if ($nameOnly == TRUE) {
			return $strName;
		} else {
			return $str;
		}
	} //end MilestoneStatus function

} //end check MilestoneStatus

if (!function_exists('MilestoneStatusList')) {

	function MilestoneStatusList()
	{
		$milestone_status = array(
			'' => '--SELECT MILESTONE STATUS--',
			'0' => 'Not Started Yet',
			'1' => 'Started',
			'2' => 'Completed',
			'3' => 'Reject',
			'4' => 'Completed & Approved'
		);

		return $milestone_status;
	} //end MilestoneStatusList function

} //end check MilestoneStatusList

if (!function_exists('MilestonePercentageList')) {

	function MilestonePercentageList()
	{
		$milestone_percentage = array(
			'' => '--SELECT MILESTONE PERCENTAGE--',
			'10' => '10%',
			'20' => '20%',
			'30' => '30%',
			'40' => '40%',
			'50' => '50%',
			'60' => '60%',
			'70' => '70%',
			'80' => '80%',
			'90' => '90%',
			'100' => '100%'
		);

		return $milestone_percentage;
	} //end MilestonePercentageList function

} //end check MilestonePercentageList

if (!function_exists('getDashboardLink')) {

	function getDashboardLink($user_type = 0)
	{
		$str = "";
		$user_type = (int)$user_type;

		switch ($user_type) {
			case 1:
				$str = anchor('company/dashboard', '<em class="nc-icon nc-dashboard-level"></em> Dashboard', array('class' => 'btn-link', 'title' => 'Company User Dashboard'));
				break;
			case 2:
				$str = anchor('individual/dashboard', '<em class="nc-icon nc-dashboard-level"></em> Dashboard', array('class' => 'btn-link', 'title' => 'Individual User Dashboard'));
				break;
			case 3:
				$str = anchor('agency/dashboard', '<em class="nc-icon nc-dashboard-level"></em> Dashboard', array('class' => 'btn-link', 'title' => 'Implementing Partner Dashboard'));
				break;
			default:
				$str = '';
				break;
		}
		return $str;
	} //end getDashboardLink function

} //end check getDashboardLink

if (!function_exists('chkEmptyNonZero')) {

	function chkEmptyNonZero($val, $addSign = FALSE)
	{
		$str = "";
		if ($val != "" && $val != 0) {
			$str = ($addSign == TRUE) ? "+" . $val : $val;
		}
		return $str;
	} //end ArchiveStatus function

} //end check ArchiveStatus

if (!function_exists('getSlider')) {
	function getSlider($category = 1, $limit = 10)
	{
		$ci = &get_instance();
		$filter = array('is_delete' => 0, 'status' => 1, 'DATE(publishdateext) <= ' => date('Y-m-d'));
		$filter['cat_id'] = $category;

		if (checkLanguage("english")) {
			$col_name = 'title_en as title,';
		} else {
			$col_name = 'title_hi as title,';
		}

		$col_name .= 'attachment,cat_id,desc_url';

		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where('comm_sliders', $filter);
		return $query->result();
	} //end getSlider function

} //end getSlider function exist
if (!function_exists('RotateArray')) {
	function RotateArray($Rec)
	{
		if (count($Rec) < 4) {
			$Rec =  array_merge($Rec, $Rec);
		} else {
			RotateArray($Rec);
		}
		return $Rec;
	}
}

if (!function_exists('CubeSlider')) {
	function CubeSlider($limit = 12)
	{
		$ci = &get_instance();
		$filter = array('is_delete' => 0, 'status' => 1, 'DATE(publishdateext) <= ' => date('Y-m-d'));

		if (checkLanguage("english")) {
			$col_name = 'title_en as title,';
		} else {
			$col_name = 'title_hi as title,';
		}

		$col_name .= 'attachment,desc_url,type,text_1,text_2,text_3,text_4';

		$ci->db->select($col_name);
		$ci->db->order_by('id DESC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where('comm_cube', $filter);
		return $query->result();
	} //end CubeSlider function

} //end CubeSlider function exist
if (!function_exists('getDrivingForce')) {
	function getDrivingForce($limit = 10)
	{
		$ci = &get_instance();
		$filter = array('is_delete' => 0, 'status' => 1, 'DATE(publishdateext) <= ' => date('Y-m-d'));

		if (checkLanguage("english")) {
			$col_name = 'title_en as title,designation_en as designation,heading_en as heading,  ';
		} else {
			$col_name = 'title_hi as title,designation_hi as designation, ,heading_hi as heading,  ';
		}

		$col_name .= 'attachment';

		$ci->db->select($col_name);
		//$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where('comm_messages', $filter);
		return $query->result();
	} //end getSlider function

} //end getSlider function exist

if (!function_exists('does_url_exists')) {
	function does_url_exists($url)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if ($code == 200) {
			$status = true;
		} else {
			$status = false;
		}
		curl_close($ch);
		return $status;
	}
}

if (!function_exists('getNotification')) {

	function getNotification()
	{
		$ci = &get_instance();
		$tbl = "comm_custom_notification";
		if (checkLanguage("english")) {
			$col_name = 'title_en as title,description_en as description, attachment';
		} else {
			$col_name = 'title_hi as title,description_hi as description, attachment';
		}
		$filter = array('status' => 1, 'is_delete' => 0, 'DATE(archive_exp_date) >=' => date('Y-m-d'));
		$ci->db->select($col_name);
		$ci->db->limit(1);
		$query = $ci->db->get_where($tbl, $filter);
		$title = '';
		$des = '';
		$attachment = '';
		if (count($query->result()) > 0) {
			foreach ($query->result() as $row) {
				$title = $row->title;
				$des = $row->description;
				$attachment = $row->attachment;
			}
			if (!empty($attachment)) {
				$title = '<a href="' . $attachment . '">' . $title . '</a>';
			}
			$str = '<!-- popup -->
			 <div class="modal fade" id="newsletter">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">



        </div>
        <div class="modal-body">
        ' . stripslashes2(html_entity_decode($des)) . '
        </div>
        <button type="button" class="close" title="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>

		 
		  
		  <!-- Popup -->
		  
		  <script type="text/javascript">
			jQuery(document).ready(function()
			{			//  jQuery("#newsletter").modal("show");
			console.log();
			});		  
		  </script>';
			return $str;
		} else {
			return ' ';
		}
	} //end NotificationKey function

} //end check NotificationKey

if (!function_exists('NotificationKey')) {

	function NotificationKey()
	{
		$key = time() + floor(rand() * 10000);
		return $key;
	} //end NotificationKey function

} //end check NotificationKey

if (!function_exists('getUnreadNotification')) {

	function getUnreadNotification($id = 0)
	{
		if ($id != 0) {
			$ci = &get_instance();
			$ci->db->select('count(1) as total_notification');
			$filter = array('recipent_id' => $id, 'is_unread' => 0);
			$query = $ci->db->get_where('comm_notification', $filter);
			$row = $query->row();

			if (isset($row)) {
				return $row->total_notification;
			}
		} //end check logged id
		return 0;
	} //end getUnreadNotification function

} //end check getUnreadNotification

if (!function_exists('getTestimonial')) {
	function getTestimonial($limit = 10)
	{
		$ci = &get_instance();
		$filter = array('is_delete' => 0, 'status' => 1);

		if (checkLanguage("english")) {
			$col_name = 'title_en as title,description_en as description,';
		} else {
			$col_name = 'title_hi as title,description_hi as description,';
		}

		$col_name .= 'attachment,attachment_video';

		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where('comm_testimonials', $filter);

		$str = '';
		if (count($query->result()) > 0) {
			foreach ($query->result() as $row) {
				$image_properties = array(
					'src'   => 'uploads/testimonial/' . html_escape($row->attachment),
					'alt'   => html_escape($row->title),
					'class' => 'img-responsive',
					'title' => html_escape($row->title)
				);


				$str .= '<div > <a data-fancybox="video" href="' . 'uploads/testimonial/' . html_escape($row->attachment_video) . '" title="' . html_escape($row->description) . ' "> <div class="gallery-item">' . PHP_EOL;
				if (isset($row->attachment) && trim($row->attachment) != "") {
					$str .= '<div class="gallery-img">';
					$str .= img($image_properties);
					$str .= '</div>';
				}

				$str .= '<div class="tbox2">
				 <h3>' . html_escape($row->title) . '</h3>
                        <p style="display:none;">' . html_escape($row->description) . '</p>
                      </div> ';
				$str .= '</div></a>' . PHP_EOL;
				$str .= '</div>' . PHP_EOL;
			}
			return $str;
		} else {
			return "";
		}
	} //end getSlider function

} //end getSlider function exist

if (!function_exists('getHomeSlider')) {
	function getHomeSlider($limit = 10)
	{
		$ci = &get_instance();
		$ci->load->helper('text');

		$filter = array('is_delete' => 0, 'status' => 1, 'DATE(publishdateext) <= ' => date('Y-m-d'));

		if (checkLanguage("english")) {
			$col_name = 'title_en as title,';
		} else {
			$col_name = 'title_hi as title,';
		}

		$col_name .= 'attachment,desc_url';

		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where('comm_sliders', $filter);

		$str = '';
		if (count($query->result()) > 0) {
			foreach ($query->result() as $row) {
				$image_properties = array(
					'src'   => 'uploads/slider/' . $row->attachment,
					'alt'   => html_escape($row->title),
					'class' => 'img-responsive',
					'title' => html_escape($row->title)
				);

				$str .= '<div class="item">' . PHP_EOL;
				$str .= img($image_properties);

				$str .= '<div class="discription">' . PHP_EOL;
				$str .= character_limiter(html_escape($row->title), 120);
				if (trim($row->desc_url) != "") {
					$str .= '<a target="_blank" href="' . $row->desc_url . '" class="btn-gallery">Read More</a>';
				} else {
					$str .= '<a target="_blank" href="javascript:void(0);" class="btn-gallery">Read More</a>';
				}

				$str .= '</div>' . PHP_EOL;
				$str .= '</div><!--End item-->' . PHP_EOL;
			}
			return $str;
		} else {
			return "";
		}
	} //end getHomeSlider function

} //end getHomeSlider function exist



if (!function_exists('getGallery')) {

	function getGallery($limit = 6)
	{
		$ci = &get_instance();
		$filter = array('is_delete' => 0, 'status' => 1, 'is_on_homepage' => 1, 'DATE(publishdateext) <= ' => date('Y-m-d'));

		if (checkLanguage("english")) {
			$col_name = 'title_en as title,';
		} else {
			$col_name = 'title_hi as title,';
		}
		$col_name .= 'attachment,cat_id';
		$ci->db->select($col_name);
		$ci->db->limit($limit);
		// $query = $ci->db->get_where(SLIDER_TBL, $filter);
		$ci->db->order_by('order_preference DESC');
		$query = $ci->db->get_where('comm_photo_gallery', $filter);
		$html = '';

		if (count($query->result()) > 0) {
			$total = count($query->result());
			foreach ($query->result() as $row) {

				if (trim($row->attachment) == "") {
					$photo = base_url() . 'assets/img/img-not-found.png';
				} else {
					$photo = base_url() . 'uploads/gallery/' . $row->attachment;
				}
				$title = stripslashes2(html_entity_decode($row->title));
				$html .= '<div>
                            <a data-fancybox="gallery" href="' . $photo . '" data-caption="Image Title">
                                <div class="gallery-item">
                                    <div class="gallery-img">
                                        <img src="' . $photo . '" alt="Image Title">
                                    </div>
                                    <div class="desp">
                                        <h5>' . $title . '</h5>
                                    </div>
                                </div>
                            </a>
                        </div>';
			}
		}


		return $html;
	}

	//end getSlider function
} //end getSlider function exist


if (!function_exists('getImpWebImg')) {
	function getImpWebImg($limit = 10)
	{
		$ci = &get_instance();
		$filter = array('is_delete' => 0, 'is_slide' => 1, 'status' => 1, 'trim(attachment)!=' => "", 'trim(attachment)!=' => NULL);

		if (checkLanguage("english")) {
			$col_name = 'title_en as title,';
		} else {
			$col_name = 'title_hi as title,';
		}

		$col_name .= 'attachment,url';

		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where('comm_important_website', $filter);
		return $query->result();
	} //end getImpWebImg function

} //end getImpWebImg function exist

if (!function_exists('getSocailLink')) {
	function getSocailLink()
	{
		$ci = &get_instance();


		$query = $ci->db->get_where('comm_social', array('link !=' => ''));
		$str = '';

		if (count($query->result()) > 0) {
			foreach ($query->result() as $row) {

				$str .= ' <a href="' . strtolower($row->link) . '" class="' . strtolower($row->li_class) . '"><i class="fa fa-' . strtolower($row->name) . '"></i> </a>';
			}
			$str .= "";
			return $str;
		} else {
			return "";
		}
	} //end getSocailLink function

} //end getSocailLink function exist

if (!function_exists('getLatestNews')) {

	function getLatestNews($limit = 5)
	{
		$ci = &get_instance();
		$tbl = "comm_news";

		if (checkLanguage("english")) {
			$col_name = 'title_en as title, description_en as description, attachment, archive_exp_date,id,publishdateext';
		} else {
			$col_name = 'title_hi as title, description_hi as description, attachment, archive_exp_date,id,publishdateext';
		}

		$col_name .= ',is_alert  ';

		$filter = array('status' => 1, 'is_archive' => 0, 'is_delete' => 0, 'is_new' => 1, 'DATE(publishdateext) <= ' => date('Y-m-d'));
		$ci->db->order_by('order_preference ASC');
		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';
		if (count($query->result()) > 0) {
			$str .= '<ul class="pricing-content-news">';
			foreach ($query->result() as $row) {
				$str .= '<li style="color:white;">';
				$str .= '<a target="_blank" href="' . base_url() . '/news-details/nid/';
				$str .= encrypt_decrypt('encrypt', $row->id);
				$str .= '">' . $row->title;
				$str .= '<span>' . date('d-m-Y', strtotime($row->publishdateext)) . '</span></a>  ';
				$str .= ' </li>';
			}
			$str .= '</ul>' . PHP_EOL;

			return $str;
		} else {
			return ' ';
		}
	} //end getLatestNews function

} //end getLatestNews function exist

if (!function_exists('getLatestVacancies')) {

	function getLatestVacancies($limit = 5)
	{
		$ci = &get_instance();
		$tbl = "comm_vacancies";

		if (checkLanguage("english")) {
			$col_name = 'title_en as title, description_en as description, attachment, archive_exp_date,id,publishdateext';
		} else {
			$col_name = 'title_hi as title, description_hi as description, attachment, archive_exp_date,id,publishdateext';
		}

		$col_name .= ',is_alert  ';

		$filter = array('status' => 1, 'is_archive' => 0, 'is_delete' => 0, 'is_new' => 1, 'DATE(publishdateext) <= ' => date('Y-m-d'));
		$ci->db->order_by('order_preference ASC');
		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';
		if (count($query->result()) > 0) {
			$str .= '<ul class="pricing-content-news">';
			foreach ($query->result() as $row) {
				$str .= '<li>' . $row->title;
				$str .= '<span>' . date('d-m-Y', strtotime($row->publishdateext)) . '</span>';
				$str .= '</li>';
			}
			$str .= '</ul>' . PHP_EOL;

			return $str;
		} else {
			return ' ';
		}
	} //end getLatestVacancies function

} //end getLatestVacancies function exist

if (!function_exists('getWhatsnew')) {

	function getWhatsnew($limit = 5)
	{
		$ci = &get_instance();
		$tbl = "comm_whats_new";

		if (checkLanguage("english")) {
			$col_name = 'title_en as title, url,is_alert';
		} else {
			$col_name = 'title_hi as title, url,is_alert';
		}

		$filter = array('status' => 1, 'DATE(archive_exp_date) >= ' => date('Y-m-d'), 'is_delete' => 0);

		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$ci->db->order_by('order_preference ASC');
		$query = $ci->db->get_where($tbl, $filter);

		if (count($query->result()) > 0) {
			$i = 1;
			$str = '';
			foreach ($query->result() as $row) {


				if ($row->is_alert == 1) {
					$isAlert = '<img src="' . base_url('assets/img/') . 'new.gif"  class="img-responsive" style="width: 10%;	height: 10%;margin-top: 7px;">';
				} else {
					$isAlert = '';
				}

				if (trim($row->url) != "" && $row->url != NULL) {
					$url =  $row->url;
				} else {
					$url = "javascript:void(0)";
				}

				$str .= '
				<div class="event_rt"> <a href="' . $url . '">' . $isAlert . substr(stripslashes2($row->title), 0, 50) .  ' </a> </div>
				';
				$i++;
			}

			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getSchemes function

} //end getSchemes function exist

if (!function_exists('importantlinkss')) {

	function importantlinkss($limit = 20)
	{
		$ci = &get_instance();
		$tbl = "comm_important_links";

		if (checkLanguage("english")) {
			$col_name = 'title_en as title, url,is_alert';
		} else {
			$col_name = 'title_hi as title, url,is_alert';
		}

		$filter = array('status' => 1, 'is_delete' => 0);

		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$ci->db->order_by('order_preference ASC');
		$query = $ci->db->get_where($tbl, $filter);

		if (count($query->result()) > 0) {
			$i = 1;
			$str = '';
			foreach ($query->result() as $row) {



				if (trim($row->url) != "" && $row->url != NULL) {
					$url =  $row->url;
				} else {
					$url = "javascript:void(0)";
				}

				$str .= '
				<div class="event_rt"> <a href="' . $url . '">' . substr(stripslashes2($row->title), 0, 50) .  ' </a> </div>
				';
				$i++;
			}

			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getSchemes function

} //end getSchemes function exist

if (!function_exists('getCirculars')) {

	function getCirculars($limit = 20)
	{
		$ci = &get_instance();
		$tbl = "comm_circulars";
		if (checkLanguage("english")) {
			$col_name = 'title_en as title, attachment,is_alert,order_date,type';
		} else {
			$col_name = 'title_hi as title, attachment,is_alert,order_date,type';
		}
		$filter = array('status' => 1, 'DATE(archive_exp_date) >= ' => date('Y-m-d'), 'is_delete' => 0, 'DATE(publishdateext) <= ' => date('Y-m-d'));
		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$ci->db->order_by('order_preference ASC');
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';
		if (count($query->result()) > 0) {
			foreach ($query->result() as $row) {

				if ($row->is_alert == 1) {
					$isAlert = '<img src="' . base_url('assets/img/') . 'new.gif"  class="img-responsive" style="width:10%">';
				} else {
					$isAlert = '';
				}
				if (trim($row->attachment) != "" && $row->attachment != NULL) {

					if ($row->type == 1) {
						$url =  $row->attachment;
					} else {
						$url = base_url('uploads/files/') . $row->attachment;
					}
				} else {
					$url = "javascript:void(0)";
				}
				$str .= '<div class="event_rt"> <a target="_blank" href="' . $url . '">' . $isAlert . ' ' . html_escape($row->title) . '  </a></div>';
			}
			if (count($query->result()) >= 5) {
				//$str .= '<li><a title="'.$ci->lang->line('view_all').'" href="'.base_url('circular').'" class="txt_link text-right">';
				//$str .= $ci->lang->line('view_all');
				//$str .= '</a></li>';
			}

			return $str;
		} else {
			return '<div class="event_rt">' . $ci->lang->line('record_not_found') . '</div>';
		}
	} //end getCirculars function

} //end getCirculars function exist

if (!function_exists('getFaq')) {
	function getFaq($limit = 5)
	{
		$ci = &get_instance();
		$tbl = "comm_faq";
		if (checkLanguage("english")) {
			$col_name = 'title_en as question,answer_en as answer ';
		} else {
			$col_name = 'title_hi as question,answer_hi as answer';
		}
		$filter = array('status' => 1, 'is_delete' => 0);
		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$ci->db->order_by('order_preference ASC');
		$query = $ci->db->get_where($tbl, $filter);
		$str = '<ul>';
		$cls = "collapse";
		$show = "show";
		$i = 0;
		if (count($query->result()) > 0) {
			foreach ($query->result() as $row) {
				$i++;
				$str .= '<li data-aos="fade-up" data-aos="fade-up" data-aos-delay="100">
				<i class="bx bx-help-circle icon-help"></i> 
				<a data-toggle="collapse" class=" ' . $cls . '" href="#faq-list-' . $i . '">
				' . html_escape($row->question) . ' <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
				<div id="faq-list-' . $i . '" class="collapse ' . $show . '" data-parent=".faq-list">
				  <p>
				  ' . html_escape($row->answer) . '
				  </p>
				</div>
			  </li>';
				$cls = "collapsed";
				$show = "";
			}

			$str  .= "</ul>";

			//	if(count($query->result())>=5){
			$str .= '<p><a title="' . $ci->lang->line('view_all') . '" href="' . base_url('faq') . '" class="txt_link text-right">';
			$str .= $ci->lang->line('view_all');
			$str .= '</a></p>';
			//	}
			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getFaq function

} //end getFaq function exist

if (!function_exists('getRouteMaps')) {
	function getRouteMaps($limit = 1)
	{
		$ci = &get_instance();
		$tbl = "comm_project_maps";
		if (checkLanguage("english")) {
			$col_name = 'title_en as title';
		} else {
			$col_name = 'title_hi as title';
		}
		$col_name .= ",attachment,type";
		$filter = array('status' => 1, 'is_delete' => 0, 'DATE(archive_exp_date) >= ' => date('Y-m-d'), 'DATE(publishdateext) <= ' => date('Y-m-d'));
		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$ci->db->order_by('order_preference ASC');
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';
		if (count($query->result()) > 0) {
			foreach ($query->result() as $row) {
				//	$str .= ' 
				//<img src="' . base_url() . '/uploads/project/' . html_escape($row->attachment) . ' " alt="">';
				if ($row->type == 2) {
					$str .= '<img src="' . base_url() . '/uploads/project/' . html_escape($row->attachment) . '" alt="">';
				} else {
					$str .= '<iframe src="' . html_escape($row->attachment) . '" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
				}
			}
			//$str  .= "</ul>";		
			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getRouteMaps function	
} //end getRouteMaps function exist

if (!function_exists('getVideoLink')) {
	function getVideoLink($limit = 1)
	{
		$ci = &get_instance();
		$tbl = "comm_video_gallery";
		if (checkLanguage("english")) {
			$col_name = 'title_en as title';
		} else {
			$col_name = 'title_hi as title';
		}
		$col_name .= ",url,type,attachment";
		$filter = array('status' => 1, 'is_delete' => 0, 'is_default' => 1, 'DATE(publishdateext) <= ' => date('Y-m-d'));
		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';
		if (count($query->result()) > 0) {
			foreach ($query->result() as $row) {
				$url = "";
				$url = ($row->type == 1) ? base_url("uploads/videogallery/" . html_escape($row->attachment)) : html_escape($row->url);
				$str .= '<div class="col-lg-4">
				<div class="video-container"><iframe class="responsive-iframe" src="' . $url . '" title="' . $row->title . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div></div>';
			}
			//$str  .= "</ul>";		
			return $str;
		} else {
			return '';
		}
	} //end getVideoLink function	
} //end getVideoLink function exist


if (!function_exists('getHomePages')) {
	function getHomePages($limit = 4)
	{
		$ci = &get_instance();
		$tbl = "comm_pages";
		if (checkLanguage("english")) {
			$col_name = 'page_title_en as title ,  page_description_en as description';
		} else {
			$col_name = 'page_title_hi as title ,  page_description_hi as description ';
		}
		$clslist = array('bxl-dribbble', 'bx-file', 'bx-tachometer', 'bx-layer');
		$col_name .= ",page_url";
		$filter = array('page_status' => 1, 'is_delete' => 0, 'is_on_homepage' => 1);
		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';
		$i = 0;
		if (count($query->result()) > 0) {
			foreach ($query->result() as $row) {
				$str .= '<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up">
				<div class="icon-box">
				  <div class="icon"><i class="bx ' . $clslist[$i] . '"></i></div>
				  <h4 class="title"><a href="' . html_escape($row->page_url) . '">' . html_escape($row->title) . '</a></h4>
				  <p class="description">' . word_limiter(strip_tags(html_entity_decode($row->description)), 30) . '</p>
				  <div class="text-center"><a href="' . html_escape($row->page_url) . '" class="btn btn-primary">Read more</a></div>
				</div></div>';
				$i++;
			}
			//$str  .= "</ul>";		
			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getHomePages function	
} //end getHomePages function exist

if (!function_exists('getCareer')) {

	function getCareer($limit = 5)
	{
		$ci = &get_instance();
		$tbl = "comm_career";
		if (checkLanguage("english")) {
			$col_name = 'title_en as title, attachment,order_date,is_new';
		} else {
			$col_name = 'title_hi as title, attachment,order_date,is_new';
		}
		$filter = array('status' => 1, 'DATE(archive_exp_date) >= ' => date('Y-m-d'), 'is_delete' => 0, 'DATE(publishdateext) <= ' => date('Y-m-d'));
		$ci->db->select($col_name . ' ,link,type');
		$ci->db->limit($limit);
		$ci->db->order_by('order_preference ASC');
		$query = $ci->db->get_where($tbl, $filter);
		$str = '  <ul class="news-list">		';
		if (count($query->result()) > 0) {
			foreach ($query->result() as $row) {

				if ($row->type == 1) {
					$url =  $row->link;
				} else {
					$url = base_url('career');
					if (trim($row->attachment) != "") :
						$url = base_url('uploads/files/') . $row->attachment;
					endif;
				}

				if ($row->is_new == 1) {
					$isAlert = '<img src="' . base_url('assets/img/') . 'new.gif"  class="img-responsive">';
				} else {
					$isAlert = '';
				}

				$str .= '<li><a target="_blank" href="' . $url . '"><i class="bx bx-chevron-right"></i>' . $isAlert . ' 
                                        ' . html_escape($row->title) . '
                                    </a></li>
                               ';
			}
			$str .= "</ul>";
			if (count($query->result()) >= 5) {
				//	$str .= '<a title="'.$ci->lang->line('view_all').'" href="'.base_url('career').'" class="txt_link text-right">';
				//	$str .= $ci->lang->line('view_all');
				//	$str .= '</a>';
			}
			return $str;
		} else {
			return '<ul class="news-list"><li>' . $ci->lang->line('record_not_found') . '</li></ul>';
		}
	} //end getCareer function

} //end getCareer function exist

if (!function_exists('getTenders')) {

	function getTenders($limit = 5)
	{
		$ci = &get_instance();
		$tbl = "comm_tender";

		if (checkLanguage("english")) {
			$col_name = 'SUBSTRING_INDEX(title_en, " ", 10) as title,is_alert,publishdateext';
		} else {
			$col_name = 'SUBSTRING_INDEX(title_hi, " ", 10) as title,is_alert,publishdateext';
		}

		$filter = array('status' => 1, 'DATE(archive_exp_date) >= ' => date('Y-m-d'), 'is_delete' => 0, 'DATE(publishdateext) <= ' => date('Y-m-d'));

		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$ci->db->order_by('id desc');
		$query = $ci->db->get_where($tbl, $filter);
		$ci->db->last_query();
		$str = '';
		if (count($query->result()) > 0) {
			foreach ($query->result() as $row) {
				$str .= '<ul class="pricing-content-news"><li>';
				$str .= html_escape($row->title);
				$str .= '<span>' . date('d-m-Y', strtotime($row->publishdateext)) . '</span>';
				$str .= '</li></ul>';
			}

			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getCirculars function	
} //end getTenders function exist

if (!function_exists('getCircularCategory')) {
	function getCircularCategory($limit = 5)
	{
		$ci = &get_instance();
		$tbl = "comm_circular_category";
		if (checkLanguage("english")) {
			$col_name = 'cat_title_en as title';
		} else {
			$col_name = 'cat_title_hi as title';
		}
		$filter = array('cat_status' => 1);
		$ci->db->select('*,' . $col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';
		if (count($query->result()) > 0) {
			$str .= '<ul>';
			foreach ($query->result() as $row) {
				$cat_id = encrypt_decrypt('encrypt', $row->cat_id);
				$str .= '<li><a title="' . $row->title . '" href="' . base_url('circular/index/') . $cat_id . '">';
				$str .= html_escape($row->title);
				$str .= '</a></li>';
			}
			$str .= '</ul>' . PHP_EOL;
			if (count($query->result()) >= 5) {
				$str .= '<a title="' . $ci->lang->line('view_all') . '" href="' . base_url('circular') . '" class="txt_link text-right">';
				$str .= $ci->lang->line('view_all');
				$str .= '</a>';
			}
			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getCircularCategory function	
} //end getCircularCategory function exist

if (!function_exists('getProjecthighlights')) {
	function getProjecthighlights($limit = 5)
	{
		$ci = &get_instance();
		$tbl = "comm_entitlement";
		if (checkLanguage("english")) {
			$col_name = 'title_en as title,description_en as description';
		} else {
			$col_name = 'title_hi as title,description_hi as description';
		}
		$filter = array('status' => 1, 'DATE(publishdateext) <= ' => date('Y-m-d'));
		$ci->db->select('*,' . $col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';
		$cls = "collapse";
		$show = "show";
		if (count($query->result()) > 0) {
			$str .= '<ul>';
			$i = 1;
			foreach ($query->result() as $row) {
				$str .= '<li data-aos="fade-up" data-aos-delay="100">
							<a data-toggle="collapse" class="' . $cls . '" href="#accordion-list-' . $i . '">
							<span>' . $i . '</span> ' . $row->title . ' <i class="bx bx-chevron-down icon-show"></i>
							<i class="bx bx-chevron-up icon-close"></i></a>
							<div id="accordion-list-' . $i . '" class="collapse ' . $show . '" 
							data-parent=".accordion-list">
								<p>' . word_limiter(strip_tags(html_entity_decode($row->description)), 100) . '</p>
							</div>
						</li>';
				$i++;
				$cls = "collapsed";
				$show = "";
			}
			$str .= '</ul>' . PHP_EOL;
			if (count($query->result()) == 5) {
				$str .= '<a title="' . $ci->lang->line('view_all') . '" href="' . base_url('Entitlement') . '" class="txt_link text-right">';
				$str .= $ci->lang->line('view_all');
				$str .= '</a>';
			}
			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getProjecthighlights function	
} //end getProjecthighlights function exist


if (!function_exists('getGelleryCategory')) {
	function getGelleryCategory($limit = 5)
	{
		$ci = &get_instance();
		$tbl = "comm_photo_gallery_category";
		if (checkLanguage("english")) {
			$col_name = 'cat_title_en as title';
		} else {
			$col_name = 'cat_title_hi as title';
		}
		$catid = array();

		$filter1 = array('is_delete' => 0, 'status' => 1);

		$ci->db->select('cat_id');
		$ci->db->limit(9);
		// $query = $ci->db->get_where(SLIDER_TBL, $filter);
		$ci->db->order_by('order_preference ASC');
		$query1 = $ci->db->get_where('comm_photo_gallery', $filter1);

		if (count($query1->result()) > 0) {
			$total = count($query1->result());
			foreach ($query1->result() as $row) {
				$catid[] =  $row->cat_id;
			}
		}

		$id = implode(',', $catid);
		$filter = array('cat_status' => 1, 'is_delete' => 0, 'cat_id in (' . $id . ')' => NULL);
		$ci->db->select('*,' . $col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';
		if (count($query->result()) > 0) {
			$str .= '<button class="btn fil-cat" href="" data-rel="all">All</button>';
			foreach ($query->result() as $row) {
				$cat_id = $row->cat_id;
				$str .= '<button class="btn fil-cat" data-rel="bcards-' . $cat_id . '">';
				$str .= html_escape($row->title);
				$str .= '</button>';
			}

			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getGelleryCategory function
}

if (!function_exists('getGalleryPhotos')) {
	function getGalleryPhotos($limit = 8)
	{
		$ci = &get_instance();
		$tbl = "comm_photo_gallery";
		if (checkLanguage("english")) {
			$col_name = 'title_en as title,attachment';
		} else {
			$col_name = 'title_hi as title,attachment';
		}

		$filter = array('status' => 1, 'is_delete' => 0);
		$ci->db->select('*,' . $col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';
		if (count($query->result()) > 0) {
			foreach ($query->result() as $row) {
				$str .= '<div class="column">
          <a data-fancybox="image" href="' . base_url() . 'uploads/gallery/' . $row->attachment . '" title=" ">
            <div class="gallery-item">
              <div class="gallery-img">
                <img src="' . base_url() . 'uploads/gallery/' . $row->attachment . '" alt=" ">
              </div>

            </div>
          </a>
        </div>';
			}

			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getGalleryPhotos function
}

if (!function_exists('getHospitalCategory')) {

	function getHospitalCategory($limit = 5)
	{
		$ci = &get_instance();
		$tbl = "comm_hospital_category";

		if (checkLanguage("english")) {
			$col_name = 'cat_title_en as title';
		} else {
			$col_name = 'cat_title_hi as title';
		}

		$filter = array('cat_status' => 1);

		$ci->db->select('*,' . $col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';
		if (count($query->result()) > 0) {
			$str .= '<ul>';
			foreach ($query->result() as $row) {
				$cat_id = encrypt_decrypt('encrypt', $row->cat_id);

				$str .= '<li><a title="' . $row->title . '" href="' . base_url('hospital/') . $cat_id . '">';
				$str .= html_escape($row->title);
				$str .= '</a></li>';
			}
			$str .= '</ul>' . PHP_EOL;

			if (count($query->result()) > 5) {
				$str .= '<a title="' . $ci->lang->line('view_all') . '" href="' . base_url('hospital') . '" class="txt_link text-right">';
				$str .= $ci->lang->line('view_all');
				$str .= '</a>';
			}
			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getHospitalCategory function

} //end getHospitalCategory function exist

if (!function_exists('getEntitlement')) {

	function getEntitlement($limit = 5, $condition = array())
	{
		$ci = &get_instance();
		$tbl = "comm_entitlement";

		$col_name = '*';
		if (checkLanguage("english")) {
			$col_name .= ',title_en as title, description_hi as description';
		} else {
			$col_name .= ',title_hi as title, description_en as description';
		}

		$filter = array('status' => 1, 'is_delete' => 0, 'DATE(publishdateext) <= ' => date('Y-m-d'));
		if (count($condition) > 0) {
			foreach ($condition as $key1 => $val1) {
				$filter[$key1] = $val1;
			}
		}

		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';

		if (count($query->result()) > 0) {
			$str .= '<ul>';
			foreach ($query->result() as $row) {

				$str .= '<li><a title="' . $row->title . '" target="_blank" href="entitlement/view/';
				$str .= encrypt_decrypt('encrypt', $row->id);
				$str .= '">';
				$str .= html_escape(word_limiter($row->title, 1));
				$str .= '</a></li>';
			}
			$str .= '</ul>' . PHP_EOL;

			/*if(count($query->result())>5){
			$str .= '<a title="'.$ci->lang->line('view_all').'" href="'.base_url('entitlement').'" class="txt_link text-right">';
			$str .= $ci->lang->line('view_all');
			$str .= '</a>';			
			}*/

			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getEntitlement function

} //end getEntitlement function exist

if (!function_exists('getImpLinks')) {

	function getImpLinks($limit = 0)
	{
		$ci = &get_instance();
		$tbl = "comm_important_links";
		$new_limit = $limit + 1;
		if (checkLanguage("english")) {
			$col_name = 'title_en as title, url';
		} else {
			$col_name = 'title_hi as title, url';
		}

		$col_name .= ' ,is_alert';
		$filter = array('status' => 1, 'is_delete' => 0);
		$ci->db->order_by('order_preference ASC');
		$ci->db->select($col_name);

		if ($limit > 0) {
			$ci->db->limit($new_limit);
		}
		$query = $ci->db->get_where($tbl, $filter);
		// print_r($ci->db->last_query());
		$str = '';
		$return = array();

		if (count($query->result()) > 0) {
			$result_set = $query->result();
			if (count($result_set) > $limit && $limit > 0) {
				unset($result_set[$limit]);
				$reindex = array_values($result_set);
				$result_set = $reindex;
			}

			$str .= '<div class="panel panel-default">';
			foreach ($result_set as $row) {
				if ($row->is_alert == 1) {
					$isAlert = '  <img src="' . base_url('assets/images/') . 'new.gif"  class="img-responsive"> ';
				} else {
					$isAlert = '';
				}
				$str .= '<div class="panel-heading"><h4 class="panel-title"> <a title="' . $row->title . '" target="_blank" href="';
				if (trim($row->url) != "" && $row->url != NULL) {
					$str .= $row->url;
				} else {
					$str .= "javascript:void(0)";
				}
				$str .= '"><i class="fa fa-hand-o-right" aria-hidden="true"></i> ';
				$str .= $isAlert;
				$str .= stripslashes2($row->title);

				$str .= '</a></div>';
			}
			$str .= '</div>' . PHP_EOL;

			/*if(count($query->result())>5){
			$str .= '<a title="'.$ci->lang->line('view_all').'" href="'.base_url('important-links').'" class="txt_link text-right">';
			$str .= $ci->lang->line('view_all');
			$str .= '</a>';
			}*/

			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getImpLinks function

} //end getImpLinks function exist

if (!function_exists('getHomeLinks')) {

	function getHomeLinks($limit = 6)
	{
		$ci = &get_instance();
		$tbl = "comm_googlesheet";
		$new_limit = $limit + 1;
		if (checkLanguage("english")) {
			$col_name = 'title_en as title, url';
		} else {
			$col_name = 'title_hi as title, url';
		}

		$col_name .= ',subject_hi ';
		$filter = array('status' => 1, 'is_delete' => 0, 'DATE(publishdateext) <= ' => date('Y-m-d'));
		$ci->db->order_by('order_preference ASC');
		$ci->db->select($col_name);

		if ($limit > 0) {
			$ci->db->limit($new_limit);
		}
		$query = $ci->db->get_where($tbl, $filter);
		// print_r($ci->db->last_query());
		$str = '';
		$return = array();

		if (count($query->result()) > 0) {
			$result_set = $query->result();
			if (count($result_set) > $limit && $limit > 0) {
				unset($result_set[$limit]);
				$reindex = array_values($result_set);
				$result_set = $reindex;
			}

			$str .= '<ul >';
			foreach ($result_set as $row) {

				$str .= '<li><a title="' . $row->title . '" target="_blank" href="';
				if (trim($row->url) != "" && $row->url != NULL) {
					$str .= $row->url;
				} else {
					$str .= "javascript:void(0)";
				}
				$str .= '"><i class="' . $row->subject_hi . '"></i><span>' . $row->title . '</span>';
				$str .= "</a></li>";
			}
			$str .= '</ul>' . PHP_EOL;

			/*if(count($query->result())>5){
			$str .= '<a title="'.$ci->lang->line('view_all').'" href="'.base_url('important-links').'" class="txt_link text-right">';
			$str .= $ci->lang->line('view_all');
			$str .= '</a>';
			}*/

			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getHomeLinks function

} //end getHomeLinks function exist

if (!function_exists('getImpWebsites')) {

	function getImpWebsites($limit = 5)
	{
		$ci = &get_instance();
		$tbl = "comm_important_website";

		if (checkLanguage("english")) {
			$col_name = 'title_en as title, url';
		} else {
			$col_name = 'title_hi as title, url';
		}

		$filter = array('status' => 1, 'is_delete' => 0);

		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';

		if (count($query->result()) > 0) {
			$str .= '<ul>';
			foreach ($query->result() as $row) {

				$str .= '<li><a title="' . $row->title . '" target="_blank" href="';
				if (trim($row->url) != "" && $row->url != NULL) {
					$str .= $row->url;
				} else {
					$str .= "javascript:void(0)";
				}
				$str .= '">';
				$str .= stripslashes2($row->title);
				$str .= '</a></li>';
			}
			$str .= '</ul>' . PHP_EOL;

			if (count($query->result()) > 5) {
				$str .= '<a title="' . $ci->lang->line('view_all') . '" href="' . base_url('important-websites') . '" class="txt_link text-right">';
				$str .= $ci->lang->line('view_all');
				$str .= '</a>';
			}

			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getImpWebsites function

} //end getImpWebsites function exist

if (!function_exists('getNoticeBoard')) {

	function getNoticeBoard($limit = 5)
	{
		$ci = &get_instance();
		$tbl = "comm_noticeboard";

		if (checkLanguage("english")) {
			$col_name = 'title_en as title, attachment';
		} else {
			$col_name = 'title_hi as title, attachment';
		}

		$filter = array('status' => 1, 'is_delete' => 0, 'DATE(archive_exp_date) >=' => date('Y-m-d'));

		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';

		if (count($query->result()) > 0) {
			$str .= '<ul>';
			foreach ($query->result() as $row) {

				$str .= '<li><a title="' . $row->title . '" target="_blank" href="';
				if (trim($row->attachment) != "" && $row->attachment != NULL) {
					$str .= base_url('uploads/files/') . $row->attachment;
				} else {
					$str .= "javascript:void(0)";
				}
				$str .= '">';
				$str .= html_escape($row->title);
				$str .= '</a></li>';
			}
			$str .= '</ul>' . PHP_EOL;

			if (count($query->result()) > 5) {
				$str .= '<a title="' . $ci->lang->line('view_all') . '" href="' . base_url('notice-board') . '" class="txt_link text-right">';
				$str .= $ci->lang->line('view_all');
				$str .= '</a>';
			}

			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getNoticeBoard function

} //end getNoticeBoard function exist


if (!function_exists('getCourses')) {

	function getCourses($limit = 5, $view_all = FALSE, $condition = array(), $class_name = "")
	{
		$ci = &get_instance();
		$tbl = "comm_courses";
		$new_limit = $limit + 1;
		$col_name = '*';
		if (checkLanguage("english")) {
			$col_name .= ',title_en as title, description_en as description,is_alert,apply_link_title_hindi as applytit';
		} else {
			$col_name .= ',title_hi as title, description_en as description,is_alert,apply_link_title_english as applytit';
		}

		$filter = array('status' => 1, 'description_en' => "yes", 'is_delete' => 0,  'DATE(archive_exp_date) > ' => date('Y-m-d'), 'DATE(publishdateext) <= ' => date('Y-m-d'));
		if (count($condition) > 0) {
			foreach ($condition as $key1 => $val1) {
				$filter[$key1] = $val1;
			}
		}

		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC , id DESC');
		$ci->db->limit($new_limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';
		$isAlert = '';
		if (count($query->result()) > 0) {

			$result_set = $query->result();
			if (count($result_set) > $limit) {
				unset($result_set[$limit]);
				$reindex = array_values($result_set); //normalize index
				$result_set = $reindex; //update variable
			}
			$bg = 1;

			foreach ($result_set as $row) {
				if ($row->is_alert == 1) {
					$isAlert = '<p>' . $ci->lang->line('admission_open') . ' </p>';
				} else {
					$isAlert = '';
				}

				$pagedata =	getPageDetails($row->description_hi);

				if (trim($row->attachment) == "") {
					$photo = base_url() . 'assets/img/img-not-found.png';
				} else {
					$photo = base_url() . 'uploads/files/' . $row->attachment;
				}
				$link = '';
				if ($row->link  != '') {
					$link = $row->link;
				}
				$str .= ' <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
								<div id="boxclr' . $bg . '" class="box">
								<a href="' . base_url($pagedata->page_url) . '">
									<img src="' . $photo . '" title="">' . $isAlert . '
									<div class="myoverlay">
										<h4>' . mb_substr($row->title, 0, 30, "UTF-8") . ' </h4>';
				if ($row->link  != ''  && $row->applytit != '') {
					$str .= '<a href="' . $row->link . '" class="button">' . $row->applytit . '</a>';
				}

				$str .= '</div></a></div></div>';
				if ($bg == 5) $bg = 1;
				$bg++;
			}
			return $str;
		} else {
			return '<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">' . $ci->lang->line('record_not_found') . '</div>';
		}
	} //end getCourses function


	function  getPageDetails($id)
	{
		$ci = get_instance();
		$filter = array('page_id' => $id);

		$col_name = "*";

		$ci->db->select($col_name);
		$query = $ci->db->get_where('comm_pages', $filter);
		return $query->row();
	} // end getSiteDetails

} //end getCourses function exist

if (!function_exists('getNews')) {

	function getNews($limit = 5, $view_all = FALSE, $condition = array(), $class_name = "")
	{
		$ci = &get_instance();
		$tbl = "comm_news";
		$new_limit = $limit + 1;
		$col_name = '*';
		if (checkLanguage("english")) {
			$col_name .= ',title_en as title, description_hi as description,is_alert';
		} else {
			$col_name .= ',title_hi as title, description_en as description,is_alert';
		}

		$filter = array('status' => 1, 'is_delete' => 0, 'DATE(archive_exp_date) > ' => date('Y-m-d'), 'DATE(publishdateext) <= ' => date('Y-m-d'));
		if (count($condition) > 0) {
			foreach ($condition as $key1 => $val1) {
				$filter[$key1] = $val1;
			}
		}

		$ci->db->select($col_name);
		$ci->db->order_by('order_preference DESC , id DESC');
		$ci->db->limit($new_limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';
		$isAlert = '';

		if (count($query->result()) > 0) {

			$result_set = $query->result();


			if (count($result_set) > $limit) {
				unset($result_set[$limit]);
				$reindex = array_values($result_set); //normalize index
				$result_set = $reindex; //update variable
			}



			//	$str  .='  <div class="vsvroll">';

			$str .= "<ul class='" . $class_name . "'>";
			foreach ($result_set as $row) {

				if ($row->is_alert == 1) {
					$isAlert = '<img src="' . base_url('assets/img/') . 'new.gif"  class="img-responsive">';
				} else {
					$isAlert = '';
				}
				$str .= '<li class="">';
				$str .= '<a target="_blank" href="' . base_url() . '/news-details/nid/';
				$str .= encrypt_decrypt('encrypt', $row->id);
				$str .= '">';
				$str .= $isAlert;
				$str .= $row->title;
				$str .= '</a>';
				$str .= '</li>';
			} //end foreach
			$str .= '</ul></div>
            ';

			if ($view_all == TRUE && count($query->result()) >= $limit) {
				//	$str .= '<a title="'.$ci->lang->line('view_all').'" href="'.base_url('news-details').'" class="newsall">';
				//	$str .= $ci->lang->line('view_all');
				//	$str .= '</a>';
			}

			return $str;
		} else {

			$str  .= '  <div class="vsvroll">';

			$str .= "<ul class='" . $class_name . "'>";
			$str .= '<li>' . $ci->lang->line('record_not_found') . '</li></ul>';
			return $str;
		}
	} //end getNews function

} //end getNews function exist

if (!function_exists('getServices')) {

	function getServices($limit = 6, $view_all = FALSE, $condition = array(), $class_name = "")
	{
		$ci = &get_instance();
		$tbl = "comm_services";
		$new_limit = $limit + 1;
		$col_name = '*';
		if (checkLanguage("english")) {
			$col_name .= ',title_en as title, description_hi as description, attachment';
		} else {
			$col_name .= ',title_hi as title, description_en as description, attachment';
		}

		$filter = array('status' => 1, 'is_delete' => 0, 'DATE(archive_exp_date) >= ' => date('Y-m-d'));
		if (count($condition) > 0) {
			foreach ($condition as $key1 => $val1) {
				$filter[$key1] = $val1;
			}
		}

		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC , id DESC');
		$ci->db->limit($new_limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';
		$isAlert = '';
		if (count($query->result()) > 0) {
			$result_set = $query->result();
			if (count($result_set) > $limit) {
				unset($result_set[$limit]);
				$reindex = array_values($result_set); //normalize index
				$result_set = $reindex; //update variable
			}
			///$str .= "<ul class='" . $class_name . "'>";
			foreach ($result_set as $row) {
				$str .= '<div class="blocksa">
            <div class="owl-carousel m' . $row->id . '">';
				$photos = explode('|', $row->attachment);
				if (empty($photos) && count($photos) == 0) {
					$photo = base_url() . '/assets/img/img-not-found.png';
				} else {
					foreach ($photos as $value) {
						$str .= '<div class="item">
                				<a href="">
                  					<figure>
                    					<div class="fig">
                      						<img src="' . base_url() . 'uploads/facilities/' . $value . '" class="image" alt="">                      
                    					</div>
                  					</figure>
                				</a>
              				</div>';
					}
				}

				$str .= '</div>
            <div class="name">
              <a href="' . base_url('facilities/view/') . encrypt_decrypt('encrypt', $row->id) . '"><h5>' . mb_substr($row->title, 0, 30, "UTF-8") . '</h5> </a>
            </div>
          </div>';
			} //end foreach
			//$str .= "</ul>";

			if ($view_all == TRUE && count($query->result()) >= $limit) {
				//	$str .= '<a title="'.$ci->lang->line('view_all').'" href="'.base_url('news-details').'" class="newsall">';
				//	$str .= $ci->lang->line('view_all');
				//	$str .= '</a>';
			}

			return $str;
		} else {
			return  $ci->lang->line('record_not_found');
		}
	} //end getServices function

} //end getServices function exist

if (!function_exists('getLastUpdate')) {

	function getLastUpdate()
	{
		$ci = &get_instance();
		$tbl = "comm_settings";

		$query = $ci->db->get_where($tbl);
		$row = $query->row_array();
		$str = '';

		if (isset($row) && count($row) > 0) {

			if ($row['last_updated_on'] != "" && $row['last_updated_on'] != "0000-00-00") {
				$str .= get_date($row['last_updated_on'], "d M Y");
			}

			return $str;
		} else {
			return "";
		}
	} //end getLastUpdate function

} //end getLastUpdate function exist

// This function is used for 
if (!function_exists('parseJsonArray')) {

	function parseJsonArray($jsonArray, $parentID = 0)
	{

		$return = array();
		foreach ($jsonArray as $subArray) {
			$returnSubSubArray = array();
			$returnPArray = array();
			if (isset($subArray->children)) {
				$returnSubSubArray = parseJsonArray($subArray->children, $subArray->id);
			}

			$return[] = array('id' => $subArray->id, 'parentID' => $parentID);
			$return = array_merge($return, $returnSubSubArray);
		}
		return $return;
	} //end parseJsonArray fucntion

} //end parseJsonArray check is exist or not

if (!function_exists('getMessageBoard')) {

	function getMessageBoard($where_in = array(), $condition = array(), $limit = 4)
	{
		$ci = &get_instance();
		$col_name = "";

		$tbl = "comm_messages";

		if (checkLanguage("english")) {
			$col_name = 'title_en as title, designation_en as designation, message_en as message,';
		} else {
			$col_name = 'title_hi as title, designation_hi as designation, message_hi as message,';
		}

		$col_name .= 'id,attachment,status';

		$filter = array('status' => 1, 'is_delete' => 0, 'DATE(publishdateext) <= ' => date('Y-m-d'));
		if (count($condition) > 0) {
			foreach ($condition as $key => $val) {
				$filter[$key] = $val;
			}
		}

		if (count($where_in) > 0) {
			$ci->db->where_in('id', $where_in);
		}


		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);

		$query = $ci->db->get_where($tbl, $filter);
		$count_rec = count($query->result());

		if ($count_rec > 0) {
			//return ($count_rec>1)?$query->result():$query->row();
			return $query->result();
		} else {
			return array();
		}
	} //end getMessageBoard function

} //end getMessageBoard function exist

if (!function_exists('getEvent')) {

	function getEvent($limit = 5, $condition = array())
	{
		$ci = &get_instance();
		$tbl = "comm_events as ev";

		$col_name = 'ev.*';
		if (checkLanguage("english")) {
			$col_name .= ',title_en as title, description_hi as description, cat_title_en as cat_title';
		} else {
			$col_name .= ',title_hi as title, description_en as description, cat_title_hi as cat_title';
		}

		$filter = array('ev.status' => 1, 'ev.is_delete' => 0);
		if (count($condition) > 0) {
			foreach ($condition as $key1 => $val1) {
				$filter[$key1] = $val1;
			}
		}

		$ci->db->select($col_name);
		$ci->db->join('comm_project_category as cpgc', 'cpgc.cat_id = ev.cat_id', 'left');
		$ci->db->order_by('order_preference DESC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';

		if (count($query->result()) > 0) {
			//  $str .='<ul class="demo1">';
			foreach ($query->result() as $row) {

				if (trim($row->attachment) == "") {
					$photo = base_url() . 'assets/img/img-not-found.png';
				} else {
					$photo = base_url() . 'uploads/events/' . $row->attachment;
				}
				$des = stripslashes2(html_entity_decode($row->description));
				$datetovidible = "";

				if (!empty($row->event_start_date) && $row->event_start_date != "0000-00-00 00:00:00") {
					$datetovidible = '<i class="">' . date('d M Y', strtotime($row->event_start_date)) . '</i>';
				}

				//$des = substr($des,0,100 ); 
				$str .= ' <div class="item">
		              <div class="box ">
		                <div class="imagesforthis">
		                  <a href="' . base_url('events/view/') . encrypt_decrypt('encrypt', $row->id) . '"><img src="' . $photo . '"></a>
		                </div> 
		                <ul class="publication">
		                  <li>
		                    <div class="content">
								<a href="' . base_url('events/view/') . encrypt_decrypt('encrypt', $row->id) . '"> <h5>' . html_escape(word_limiter($row->title, 10)) . '</h5></a>
		                     		        <div class="flex">
		                        ' . $datetovidible . '
		                        <a href="' . base_url('events/view/') . encrypt_decrypt('encrypt', $row->id) . '" class="readmore">' . $ci->lang->line('read_more') . ' <i
		                            class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
		                        </a>
		                      </div>
		                    </div>
		                  </li>
		                </ul>
		              </div>
		            </div>';

				/*$str .= '<a href="' . base_url('events/view/') . encrypt_decrypt('encrypt', $row->id) . '" class="single-event">';
				$str .= '</a>'; */
			}
		}
		$str .= PHP_EOL;


		return $str;
	} //end getEvent function

} //end getEvent function exist

if (!function_exists('getProjectlist')) {

	function getProjectlist($limit = 2, $condition = array())
	{
		$ci = &get_instance();
		$tbl = "comm_project";
		$col_name = '*';
		if (checkLanguage("english")) {
			$col_name .= ',title_en as title';
		} else {
			$col_name .= ',title_hi as title';
		}

		$filter = array('status' => 1, 'is_delete' => 0, 'DATE(publishdateext) <= ' => date('Y-m-d'));
		if (count($condition) > 0) {
			foreach ($condition as $key1 => $val1) {
				$filter[$key1] = $val1;
			}
		}

		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';

		if (count($query->result()) > 0) {
			//  $str .='<ul class="demo1">';
			foreach ($query->result() as $row) {
				$str .= ' <a href="' . base_url("project/view/") . '/' . encrypt_decrypt('encrypt', $row->id) . '" class="btn btn-primary btn-sm">' . $row->title . '</a>';
			}
		}
		$str .= PHP_EOL;


		return $str;
	} //end getProjectlist function

} //end getProjectlist function exist

if (!function_exists('getProject')) {

	function getProject($limit = 5, $condition = array())
	{
		$ci = &get_instance();
		$tbl = "comm_project_category";

		$col_name = '*';
		if (checkLanguage("english")) {
			$col_name .= ',cat_title_en as title';
		} else {
			$col_name .= ',cat_title_hi as title';
		}

		$filter = array('cat_status' => 1, 'is_delete' => 0, 'DATE(publishdateext) <= ' => date('Y-m-d'));
		if (count($condition) > 0) {
			foreach ($condition as $key1 => $val1) {
				$filter[$key1] = $val1;
			}
		}

		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';

		if (count($query->result()) > 0) {
			//  $str .='<ul class="demo1">';
			foreach ($query->result() as $row) {

				if (trim($row->attachment) == "") {
					$photo = base_url() . 'assets/img/img-not-found.png';
				} else {
					$photo = base_url() . 'uploads/project/' . $row->attachment;
				}
				$str .= '<div>';
				$str .= '<a href="' . base_url('project-view/') . encrypt_decrypt('encrypt', $row->cat_id) . '" class="single-event">';
				$str .= '<figure class="event-thumb">';
				$str .= '<img src="' . $photo . '" class="gal-thumb img-responsive" alt="' . html_escape(word_limiter($row->title, 15)) . '">';
				$str .= '</figure>';
				$str .= '<div class="event-info">';
				$str .= '<h3 class="bold">' . html_escape(word_limiter($row->title, 15)) . '</h3>';
				//$str .='<div>'.$des.'</div>';
				$str .= '</div>';
				$str .= '</a>';
				$str .= '</div>';
			}
		}
		$str .= PHP_EOL;


		return $str;
	} //end getProject function

} //end getProject function exist


if (!function_exists('getSchemes')) {

	function getSchemes($limit = 5, $condition = array())
	{
		$ci = &get_instance();
		$tbl = "comm_schemes";

		$col_name = '*';
		if (checkLanguage("english")) {
			$col_name .= ',title_en as title, description_hi as description';
		} else {
			$col_name .= ',title_hi as title, description_en as description';
		}

		$filter = array('status' => 1, 'is_delete' => 0, 'is_archive' => 0);
		if (count($condition) > 0) {
			foreach ($condition as $key1 => $val1) {
				$filter[$key1] = $val1;
			}
		}

		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';

		if (count($query->result()) > 0) {
			$str .= '<table class="table tenderlist">';
			foreach ($query->result() as $row) {

				$str .= '<tr><td><a title="' . $row->title . '" target="_blank" href="schemes/view/';
				$str .= encrypt_decrypt('encrypt', $row->id);
				$str .= '"><p>';
				$str .= html_escape($row->title);
				$str .= '</p></a></td></tr>';
			}
			$str .= '</table>' . PHP_EOL;

			if (count($query->result()) > 5) {
				$str .= '<a title="' . $ci->lang->line('view_all') . '" href="' . base_url('schemes') . '" class="txt_link text-right">';
				$str .= $ci->lang->line('view_all');
				$str .= '</a>';
			}

			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getSchemes function

} //end getSchemes function exist


if (!function_exists('getDownloads')) {

	function getDownloads($limit = 5, $condition = array())
	{
		$ci = &get_instance();
		$tbl = "comm_forms_download";

		$col_name = '*';
		if (checkLanguage("english")) {
			$col_name .= ',title_en as title';
		} else {
			$col_name .= ',title_hi as title';
		}

		$filter = array('status' => 1, 'is_delete' => 0, 'is_archive' => 0);
		if (count($condition) > 0) {
			foreach ($condition as $key1 => $val1) {
				$filter[$key1] = $val1;
			}
		}

		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';

		if (count($query->result()) > 0) {
			$str .= '<table class="table tenderlist">';
			foreach ($query->result() as $row) {

				$str .= '<tr><td><a title="' . $row->title . '" target="_blank" href="' . base_url() . '/uploads/files/';
				$str .= $row->attachment;
				$str .= '"><p>';
				$str .= html_escape($row->title);
				$str .= '</p></a></td></tr>';
			}
			$str .= '</table>' . PHP_EOL;

			if (count($query->result()) > 5) {
				$str .= '<a title="' . $ci->lang->line('view_all') . '" href="' . base_url('downloads') . '" class="txt_link text-right">';
				$str .= $ci->lang->line('view_all');
				$str .= '</a>';
			}

			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getDownloads function

} //end getDownloads function exist

if (!function_exists('getLandingPage')) {

	function getLandingPage()
	{
		$ci = &get_instance();
		$tbl = "comm_landing_page";

		$col_name = 'id,status';
		if (checkLanguage("english")) {
			$col_name .= ',title_en as title, description_en as description';
		} else {
			$col_name .= ',title_hi as title, description_hi as description';
		}

		$ci->db->select($col_name);
		$query = $ci->db->get_where($tbl, array('status' => 1));
		$row = $query->row();

		if (isset($row) && $row->status == 1) {
			return array('status' => TRUE, 'title' => html_escape($row->title), 'description' => $row->description);
		} else {
			return array('status' => FALSE, 'title' => '', 'description' => '');
		}
	} //end getLandingPage function

} //end getLandingPage function exist


if (!function_exists('getPagebyTitle')) {

	function getPagebyTitle($title)
	{
		$ci = &get_instance();
		$tbl = "comm_pages";
		$col_name = 'page_id,page_status,page_url';
		if (checkLanguage("english")) {
			$col_name .= ',page_title_en as title, page_description_en as description';
		} else {
			$col_name .= ',page_title_hi as title, page_description_hi as description';
		}
		$filter = array('page_status' => 1, 'is_delete' => 0, '(LOWER(page_title_hi) like "' . strtolower($title) . '" or LOWER(page_title_en) like "' . strtolower($title) . '")' => null);
		$ci->db->select($col_name);
		$ci->db->limit(1);
		$query = $ci->db->get_where($tbl, $filter);
		$row = $query->row();
		if (isset($row) && $row->page_status == 1) {
			return array('status' => TRUE, 'page_url' => $row->page_url, 'title' => html_escape($row->title), 'description' => $row->description);
		} else {
			return array('status' => FALSE, 'title' => '', 'description' => '', 'page_url' => '');
		}
	} //end getPagebyTitle function

} //end getPagebyTitle function exist


if (!function_exists('getStory')) {
	function getStory($limit = 10)
	{
		$ci = &get_instance();
		$filter = array('status' => 1, 'is_delete' => 0, 'archive_exp_date >' => date('Y-m-d H:i:s'), 'DATE(publishdateext) <= ' => date('Y-m-d'));

		if (checkLanguage("english")) {
			$col_name = 'title_en as title,description_en as description,';
		} else {
			$col_name = 'title_hi as title,description_hi as description,';
		}

		$ci->db->select('*,' . $col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where('comm_story', $filter);

		$str = '';

		if (count($query->result()) > 0) {

			foreach ($query->result() as $row) {

				$id = encrypt_decrypt('encrypt', $row->id);
				$img_path = base_url('uploads/files/' . $row->attachment);
				$url_path = base_url('story/view/' . $id);

				$str .= '<div class="pro-item">';
				$str .= img(array('src' => $img_path, 'title' => $row->title, 'alt' => $row->title));
				$str .= '<div class="pro-detail">';
				$str .= '<a class="btn" href="' . $url_path . '" title="' . html_escape($row->title) . '">';
				$str .= '<i class="mdi mdi-launch"></i> ' . $ci->lang->line('know_more');
				$str .= '</a>';
				$str .= '</div>';
				$str .= '</div>' . PHP_EOL;
			}


			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end getStory function

} //end getStory function exist

if (!function_exists('AmountINLakhs')) {

	function AmountINLakhs($val)
	{
		$value = 0;
		if (is_numeric($val) && $val != 0) {
			$value = $val / 100000;
		}
		return $value;
		/*	
	if ((number < 0) || (number > 999999999)){
        return "NUMBER OUT OF RANGE!";
    }
    var Gn = floor(number / 10000000);  // Crore 
    var kn = floor(number / 100000);    // Lakhs
    var Hn = floor(number / 1000);      // Thousand 
    var Dn = floor(number / 100);       // Tens (deca) 
    */
	} //end AmountINLakhs function

} //end check AmountINLakhs

if (!function_exists('EmergencyContact')) {
	function EmergencyContact()
	{
		$ci = &get_instance();
		$filter = array('enabled' => 1);

		if (checkLanguage("english")) {
			$col_name = 'id,district_name,district_name as district,';
			$ci->db->order_by('district_name ASC');
		} else {
			$col_name = 'id,district_name,district_name_h as district,';
			$ci->db->order_by('district_name_h ASC');
		}

		$ci->db->select($col_name);
		$query = $ci->db->get_where('comm_district', $filter);

		$str = '';

		if (count($query->result()) > 0) {
			$str .= '<div class="emrgency-contact-wrapper">';
			$str .= '<h2>Emergency Contact</h2>';
			$str .= '<form class="form-horizontal" action="' . base_url('EmergencyContact') . '" method="post">';
			$str .= '<label>Select District</label>';
			$str .= '<div class="col-md-10 nopadding">';
			$str .= '<select name="searchdistrict" class="form-control">';
			$str .= '<option>' . $ci->lang->line('all_district') . '</option>';
			foreach ($query->result() as $row) {

				$id = encrypt_decrypt('encrypt', $row->id);
				$str .= '<option value="' . html_escape($row->district_name) . '">' . html_escape($row->district) . '</option>';
			}
			$str .= '</select>';
			$str .= '</div>';
			$str .= '<div class="col-md-2 nopadding">';
			$str .= '<button class="btn btn-warning" type="submit"><span class="fa fa-search"></span></button>';
			$str .= '</div>';
			$str .= '</form>';
			$str .= '<div class="clearfix"></div>';
			$str .= '<div class="wheateher-wrapper">';
			$str .= '<a href="http://www.imd.gov.in/pages/allindiawxfcbulletin.php" target="_blank">';
			$str .= '<img src="' . base_url('assets/images/wheateher.jpg') . '" class="img-responsive center-block" alt="Wheather-Photo">';
			$str .= '</a>';
			$str .= '</div>';
			$str .= '</div>' . PHP_EOL;

			return $str;
		} else {
			return $ci->lang->line('record_not_found');
		}
	}
}

if (!function_exists('getPublication')) {

	function getPublication($pub_id = 0)
	{

		$str = "";
		$pub_id = (int)$pub_id;
		$ci = &get_instance();
		if (checkLanguage("english")) {
			$col_name = 'title_en as title, author_en as author ';
		} else {
			$col_name = 'title_hi as title, author_hi as author ';
		}
		$filter = array('id' => $pub_id, 'DATE(publishdateext) <= ' => date('Y-m-d'));
		$query = $ci->db->select($col_name . ' ,id, cat_id')->get_where('comm_publications', $filter);
		$row = $query->row();

		return $row;
	} //end getAdminType function

} //end check getAdminType
if (!function_exists('getLocation')) {

	function getLocation($id = 0)
	{

		$str = "";
		$id = (int)$id;
		$ci = &get_instance();
		if (checkLanguage("english")) {
			$col_name = 'location_name_en as name';
		} else {
			$col_name = 'location_name_hi as name';
		}
		$filter = array('id' => $id);
		$query = $ci->db->select($col_name . ' ,id')->get_where('comm_location', $filter);
		$row = $query->row();

		return $row;
	} //end getLocation function

} //end check getLocation

//SELECT publication_date FROM `comm_publications` order by publication_date ASC limit 1

if (!function_exists('getoldRecords')) {

	function getoldRecords($tbl, $column)
	{
		$startyear = date("Y");
		$ci = &get_instance();
		$query = $ci->db->query('SELECT ' . $column . ' FROM ' . $tbl . ' order by ' . $column . ' ASC  limit 1');
		$result  = $query->row();
		if ($result) {
			$startyear = date("Y", strtotime($result->publication_date));
		}

		return $startyear;
	} //end getAdminType function

} //end check getAdminType

/**
 *  Check if an array is a multidimensional array.
 *
 *  @param   array   $arr  The array to check
 *  @return  boolean       Whether the the array is a multidimensional array or not
 */
if (!function_exists('getFinancialYear')) {

	function getFinancialYear($tbl, $column)
	{

		$ci = &get_instance();
		$query = $ci->db->query('SELECT * FROM ' . $tbl . ' order by ' . $column . ' ASC  ');
		$result  = $query->result();

		return $result;
	} //end getFinancialYear function

} //end check getFinancialYear
if (!function_exists('getRecordByID')) {

	function getRecordByID($tbl, $id, $column)
	{
		$ci = &get_instance();
		$filter = array('id' => $id, 'status' => 0);
		$query = $ci->db->select($column)->get_where($tbl, $filter);
		$row = $query->row();
		if (count($row) > 0) {
			return $row->display_year;
		}
		return '';
	} //end getRecordByID function

} //end check getRecordByID
/**
 *  Check if an array is a multidimensional array.
 *
 *  @param   array   $arr  The array to check
 *  @return  boolean       Whether the the array is a multidimensional array or not
 */
function is_multi_array($x)
{
	if (count(array_filter($x, 'is_array')) > 0) return true;
	return false;
}

/**
 *  Convert an object to an array.
 *
 *  @param   array   $object  The object to convert
 *  @return  array            The converted array
 */
function object_to_array($object)
{
	if (!is_object($object) && !is_array($object)) return $object;
	return array_map('object_to_array', (array) $object);
}

/**
 *  Check if a value exists in the array/object.
 *
 *  @param   mixed    $needle    The value that you are searching for
 *  @param   mixed    $haystack  The array/object to search
 *  @param   boolean  $strict    Whether to use strict search or not
 *  @return  boolean             Whether the value was found or not
 */
function search_for_value($needle, $haystack, $strict = true)
{
	$haystack = object_to_array($haystack);

	if (is_array($haystack)) {
		if (is_multi_array($haystack)) {   // Multidimensional array
			foreach ($haystack as $subhaystack) {
				if (search_for_value($needle, $subhaystack, $strict)) {
					return true;
				}
			}
		} elseif (array_keys($haystack) !== range(0, count($haystack) - 1)) {    // Associative array
			foreach ($haystack as $key => $val) {
				if ($needle == $val && !$strict) {
					return true;
				} elseif ($needle === $val && $strict) {
					return true;
				}
			}

			return false;
		} else {    // Normal array
			if ($needle == $haystack && !$strict) {
				return true;
			} elseif ($needle === $haystack && $strict) {
				return true;
			}
		}
	}

	return false;
}



if (!function_exists('getallWhatsnew')) {
	function getallWhatsnew($page_slug = '')
	{
		if (checkLanguage("english")) {
			$column = 'id, title_en as title ';
		} else {
			$column = 'id, title_hi as title';
		}

		$ci = get_instance();
		$sql = 'SELECT * from 
				(SELECT ' . $column . ',attachment,edit_date, "" as  url, "comm_events" as type FROM comm_googlesheet 
				where is_new=1 and status=1  and is_delete=0 AND `archive_exp_date` >= NOW()
				union 
				SELECT ' . $column . ',attachment,edit_date, url, "comm_googlesheet" as type FROM comm_googlesheet 
				where is_new=1 and status=1  and is_delete=0 AND `archive_exp_date` >= NOW()
				union 
				SELECT ' . $column . ',attachment,edit_date, "" as  url, "comm_rules_acts" as type FROM comm_rules_acts 
				where is_new=1 and status=1  and is_delete=0 AND `archive_exp_date` >= NOW()
				union 
				SELECT ' . $column . ',attachment,edit_date,"" as  url,  "comm_rti" as type FROM comm_rti 
				where is_new=1 and status=1  and is_delete=0 AND `archive_exp_date` >= NOW()
				union 
				SELECT ' . $column . ',attachment,edit_date, "" as  url, "comm_circulars" as type FROM comm_circulars 
				where is_new=1 and status=1 and is_archive=0 and is_delete=0 AND `archive_exp_date` >= NOW()
				union 
				SELECT ' . $column . ',attachment,edit_date, "" as  url,   "comm_news" as type  FROM comm_news 
				where is_new=1 and status=1 and is_archive=0 and is_delete=0 AND `archive_exp_date` >= NOW() )as t
				order by edit_date desc  LIMIT 20';

		$query = $ci->db->query($sql, array($page_slug));
		$result = $query->row();
		$str = "";
		if (count($query->result()) > 0) {
			$str .= '<ul class="carouselTicker__list">';

			foreach ($query->result() as $row) {

				$str .= '<li class="carouselTicker__item"><a title="' . html_escape($row->title) . '" target="_blank" href="';
				if ($row->type == "comm_circulars") {
					$str .= base_url('/uploads/files/') . html_escape($row->attachment);
				} else if ($row->type == "comm_rti") {
					$str .= base_url('/uploads/files/') . html_escape($row->attachment);
				} else if ($row->type == "comm_news") {
					$str .= base_url('news-details/nid/') . encrypt_decrypt('encrypt', $row->id);
				} else if ($row->type == "comm_events") {
					$str .= base_url('events/view/') . encrypt_decrypt('encrypt', $row->id);
				} else if ($row->type == "comm_pages") {
					$str .= base_url($row->id);
				} else if ($row->type == "comm_googlesheet") {
					$str .= $row->url;
				} else {
					$str .= base_url('/uploads/files/') . html_escape($row->attachment);
				}
				$str .= '">';
				$str .= $isAlert;
				$str .= html_escape(stripslashes2($row->title));
				//$str .= $isAlert;
				$str .= '</a></li>';
			}
			$str .= '</ul>' . PHP_EOL;


			$html = '        <div class="breakingNews">
          <div class="container pr">
            <a href="' . base_url('whats-new') . '" class="news-more">' . $ci->lang->line('view_all') . ' </a>
            <span class="news-title"> ' . $ci->lang->line('announcment') . '<i class="fa fa-bullhorn" aria-hidden="true"
                style="color: yellow;"></i></span>
            <div id="bn1" class="carouselTicker">
             ' . $str . '
            </div>
          </div>
        </div>
		';
			return $html;
		} else {
			return $ci->lang->line('record_not_found');
		}
	} //end function getallWhatsnew
} //end exist getallWhatsnew

if (!function_exists('getDepartment')) {
	function getDepartment()
	{
		$ci = &get_instance();
		$tbl = "comm_departments";
		if (checkLanguage("english")) {
			$col_name = 'department_name as title,department_id,';
		} else {
			$col_name = 'department_name_hi as title,department_id,';
		}


		$filter = array('status' => 1, 'is_delete' => 0);
		$ci->db->order_by('department_name ASC');
		$ci->db->select($col_name);
		$query = $ci->db->get_where($tbl, $filter);
		/*$str = '<select id="department" class="form-control select2me"> 
		<option value="'.$ci->lang->line('select_department').'">'.$ci->lang->line('select_department').'</option> '.'<option value="M.P. Works Quality Council" selected>M.P. Works Quality Council</option> '.'<option value="all">Select All</option> ';
*/
		$str = '<select id="department" class="form-control select2me"><option value="M.P. Works Quality Council" selected>M.P. Works Quality Council</option> ';

		if (count($query->result()) > 0) {
			foreach ($query->result() as $row) {
				//$str .= ' <option value="'.$row->department_id.'">'.$row->title.'</option>';
			}
			$str .= '</select>';
			return $str;
		} else {
			return ' ';
		}
	}
}
