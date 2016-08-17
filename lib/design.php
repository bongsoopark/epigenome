<?php

class Design {
	var $data = "";
	var $rdata = "";
	var $hashdata = "";
	var $internaldata = array("_sidx" => 0);
	var $default_directory_template = "";
	var $default_directory_data = "";
	var $section_stack = array();
	var $filename = "";

	function Design() {
		global $Conf;
		if ($Conf["DEFAULT_DIRECTORY_TEMPLATE"] != "") {
			$this->setDefaultDirectoryTemplate($Conf["DEFAULT_DIRECTORY_TEMPLATE"]);
		}
		if ($Conf["DEFAULT_DIRECTORY_DATA"] != "") {
			$this->setDefaultDirectoryData($Conf["DEFAULT_DIRECTORY_DATA"]);
		}
	}

	function setDefaultDirectory($dir) {
		$dir = trim($dir);
		if ($dir == "") return;

		if (substr($dir, strlen($dir)-1, 1) != "/") $dir .= "/";
		$this->default_directory_template = $dir;

		$dir = preg_replace("/template/", "data", $dir);
		$this->default_directory_date = $dir;
	}

	function setDefaultDirectoryTemplate($dir) {
		$dir = trim($dir);
		if ($dir == "") return;

		if (substr($dir, strlen($dir)-1, 1) != "/") $dir .= "/";
		$this->default_directory_template = $dir;
	}

	function setDefaultDirectoryData($dir) {
		$dir = trim($dir);
		if ($dir == "") return;

		if (substr($dir, strlen($dir)-1, 1) != "/") $dir .= "/";
		$this->default_directory_data = $dir;
	}

	function readTemplate($filename) {
		global $Conf;
		$buffer = "";
		$template_file = $Conf["DEFAULT_DIRECTORY_TEMPLATE"]."/".$filename;
		$fp = fopen($template_file, "r");
		if ($fp == NULL) {
			echo("template file error:".$template_file);exit;
			return -1;
		}

		while (!feof ($fp)) {
			$buffer .= fgets($fp, 4096);
		}
		fclose($fp);
		if (strlen($buffer) < 1) { return -1; }
		$this->data = $buffer;

		$this->filename = $filename;
		return 1;
	}

	function loadData($filename) {

		if (substr($filename, 0, 1) != "/" && $this->default_directory_data != "") $filename = $this->default_directory_data.$filename;

		$data = file($filename);

		//data 파일을 읽어들인다.
		$continueFlag = 0;
		for ($i=0;$i<count($data);$i++) {
			if ($data[$i][0] == "#") continue;
			if ($continueFlag == 0) {
				$linedata = preg_split("/\s+/", $data[$i]);
				$key = array_shift($linedata);
				$value = join(" ", $linedata);
		
				//value후 후처리작업	
				if (substr($value, 0, 1) == "@") {
					$filename = trim(substr($value, 1, strlen($value)-1));
					if (substr($filename, 0, 1) != "/") {
						$filename = "./template/".$filename;
					}
					$buffer = "";
					@$fp = fopen($filename, "r");
					if ($fp == NULL) {
						$this->errorMsg("[".$filename."] file doesn't exist! Check whether file exists!");
					}
						
					while (!feof($fp)) {
						$buffer .= fgets($fp, 1024);
					}
					fclose($fp);
					$value = $buffer;
				} else if (substr($value, 0, 2) == "%%") {
					$value = substr($value, 2, strlen($value)-2);
					$continueFlag = 1;
				}

				$this->hashdata[$key] = trim($value);
			} else {
				//echo("debug2 : [$data[$i]]<br>");
				exit;
				$value = $data[$i];
				$value2 = trim($value);
				if (substr($value2, strlen($value2)-2, 2) == "%%") {
					$value2 = substr($value2, 0, strlen($value2)-2);
					$this->hashdata[$key] .= $value2;
					$continueFlag = 0;
				} else {
					$this->hashdata[$key] .= $value2."\n";
				}
			}
		}
	}

	function parsing($data = array("_" => "_"), $tempdata = "", $option = 0) {
		if ($tempdata == "") { $tempdata = $this->data; $this->rdata = ""; } 

		$tempdata_len = strlen($tempdata);
		$tokens = array();
		$pos = 0;
		$flag = 0;
		for ($i=0;$i<$tempdata_len-1;$i++) {
			if (substr($tempdata, $i, 2) == "%%") {
				if ($flag == 0) {
					$tmp_token = substr($tempdata, $pos, ($i-$pos));
					$flag = 1;
					$pos = $i;
				} else {
					$tmp_token = substr($tempdata, $pos, ($i-$pos)+2);
					$flag = 0;
					$pos = $i+2;
					$i+=1;
				}
				if ($tmp_token != "") {
					array_push($tokens, $tmp_token);
				}
			}
		}
		if ($flag == 1) {
			for ($i=0;$i<count($tokens);$i++) {
				if (substr($tokens[$i], 0, 2) == "%%") {
					$msg .= ($i+1)." th token : [".htmlspecialchars($tokens[$i])."]<br>\n";
				}
			}
			$this->errorMsg("$msg<br>Ghost Template Engine Error 1: Please check \"%%\" symbol.");
			exit;
		}
		array_push($tokens, substr($tempdata, $pos, ($i-$pos)+1));

		$add_flag = 1;		//제어문에 의한 데이터 추가 여부 판단 (1:추가, 0:보류)
		$if_stack = array();	//if_stack 을 정의한다.
		$ifelse_stack = array();//ifelse_stack 을 정의한다. (현재 위치의 if문의 상태가 if 인지 else인지 저장한다(0/1)
		$for_stack = array();	//for_stack 을 정의한다.
		for ($i=0;$i<count($tokens);$i++) {
			if (substr($tokens[$i], 0, 2) == "%%") {
				$token_each = substr($tokens[$i], 2, strlen($tokens[$i])-4);

				if (substr($token_each, 0, 1) == "!") {
					if (preg_match("/^\\!if/", $token_each)) {
						if ($add_flag == 1) {
							$if_phase = "(".trim(substr($token_each, 3, strlen($token_each)-1)).")";
							$if_phase = $this->replace_data_variables($if_phase, $data, 1);
							eval("\$if_result = $if_phase;");
							if ($if_result == "") { $if_result = 0; }
						} else {
							$if_result = 0;
						}

						array_push($if_stack, $if_result);
						array_push($ifelse_stack, 0);			//if status
						if (!checkIfStatusIF($if_stack, $ifelse_stack)) {
							$add_flag = 0;
						} else {
							$add_flag = $if_result;
						}
					} elseif (preg_match("/^\\!else/", $token_each)) {
						$ifelse_stack[count($ifelse_stack)-1] = 1;	//else status
						if (!checkIfStatusIF($if_stack, $ifelse_stack)) {
							$add_flag = 0;
						} else if (count($if_stack) == 1) {
							if ($if_stack[count($if_stack)-1] == 0) $add_flag = 1; else $add_flag = 0;
						} else {
							if ($if_stack[count($if_stack)-1] == 0) {
								$add_flag = 1;
							} else {
								$add_flag = 0;
							}
						}
					} else if (preg_match("/^\\!endif/", $token_each)) {
						array_pop($if_stack);
						array_pop($ifelse_stack);
						if (count($if_stack) > 0) {
							$add_flag = $if_stack[count($if_stack)-1];
						} else {
							$add_flag = 1;
						}
					}
				}
				if ($add_flag == 1) {
					if (substr($token_each, 0, 1) == "&") {
						$function_name = substr($token_each, 1, strlen($token_each)-1);
						$function_name = $this->replace_data_variables($function_name, $data);
						eval("\$result = $function_name;");
						$token_each = preg_replace("/\\(/", '\\\(', $token_each);
						$token_each = preg_replace("/\\)/", '\\\)', $token_each);
						$token_each = preg_replace("/\\$/", '\\\$', $token_each);
						$token_each = preg_replace("/\\&/", '\\\&', $token_each);
						$token_each = preg_replace("/\\?/", '\\\?', $token_each);
						$token_each = preg_replace("/\\'/", '\\\'', $token_each);
						$token_each = preg_replace("/\\\"/", '\\\"', $token_each);
						$token_each = preg_replace('/\\//', '\\\/', $token_each);
					} else if (substr($token_each, 0, 1) == "$") {
						$length = strlen($token_each)-1;
						$variable_name = substr($token_each, 1, $length);
						if (checkDataExist($variable_name, $data)) {
							$result = $this->replace_data_variables($token_each, $data);
						} else {
							$result = "";
						}
						$token_each = preg_replace('/\\$/', '\\\$', $token_each);
					} else if (substr($token_each, 0, 1) == "^") {
						$length = strlen($token_each)-1;
						$variable_name = substr($token_each, 1, $length);
						$token_each = preg_replace("/^\\^/", "$", $token_each);

						if (checkDataExist($variable_name, $data)) {
							$result = $this->replace_data_variables($token_each, $data, 2);
						} else {
							$result = "";
						}
						$token_each = preg_replace('/\\$/', '\\\$', $token_each);
					} else if (substr($token_each, 0, 1) == "#") {
						if (preg_match("/\\#([\\_\\d\\w]+)/", $token_each, $matches)) {
							$result = $this->internaldata[$matches[1]];
						} else {
							$result = "";
						}
					} else if (substr($token_each, 0, 1) == "!") {
						if (preg_match("/^\\!for/", $token_each)) {
							if (preg_match("/^\\!for\\s*\\((.+?)\\;\\s*(.+?)\\;\\s*(.+?)\s*\\)/", $token_each, $matches)) {
								if (count($for_stack) == 0 || (count($for_stack) > 0 && $for_stack[count($for_stack)-1][start_point] != $i)) {
									$matches[1] = preg_replace("/\\#([\\d\\w]+)/", "\$this->internaldata[\\1]", $matches[1]);
									eval($matches[1].";");

									$for_stack[count($for_stack)][start_point] = $i;
								} else {
									$matches[3] = preg_replace("/\\#([\\d\\w]+)/", "\$this->internaldata[\\1]", $matches[3]);
									eval($matches[3].";");
								}

								$matches[2] = preg_replace("/\\#([\\d\\w]+)/", "\$this->internaldata[\\1]", $matches[2]);
								eval("\$loop_result = ($matches[2]);");

								if (!$loop_result) {
									$for_stack[count($for_stack)-1][active] = 0;
									if (!empty($for_stack[count($for_stack)-1][end_point])) {
										$i = $for_stack[count($for_stack)-1][end_point]-1;
										next;
									}
								} else {
									$for_stack[count($for_stack)-1][active] = 1;
								}
							} else {
								$this->errorMsg("for 문법 에러!");
							}
						} else if (preg_match("/^\\!endfor/", $token_each)) {
							if (count($for_stack) == 0) {
								$this->errorMsg("invalid endfor!");
							}

							$for_stack[count($for_stack)-1][end_point] = $i;

							if ($for_stack[count($for_stack)-1][active] == 1) {
								$i = $for_stack[count($for_stack)-1][start_point]-1;
								next;
							} else {
								array_pop($for_stack);
							}
						} else if (preg_match("/^\\!section/", $token_each)) {
							if (count($this->section_stack) == 0 || (count($this->section_stack) > 0 && $this->section_stack[count($this->section_stack)-1][start_point] != $i)) {

								if (preg_match("/^\\!section\\s*\\((.+?)\\)/", $token_each, $matches)) {
									$temp_argument = split(";", $matches[1]);
									if (count($temp_argument) < 1 || count($temp_argument) > 5) {
										//만약 argument 수가 맞지 않으면.. 
										$this->errorMsg("section argument error! please check argument");
									}
									$this->section_stack[count($this->section_stack)][start_point] = $i;
									for ($j=0;$j<count($temp_argument);$j++) {
										list($label, $value) = split("=", $temp_argument[$j]);
										$label = trim(strtolower($label));
										$value = trim($value);
										switch ($label) {
											case "data":
												$value = trim($value);
												$value .= "[";
												preg_match("/^\\$(.+?)\\[/", $value, $matches);
												$value = $matches[1];
												
												if (empty($data[$value])) {
													//데이터가 없는 경우
													$this->errorMsg("section data variable is undefined [$value]");
												} else {
												}
												$this->section_stack[count($this->section_stack)-1][data_count] = count($data[$value]);
												break;
											case "start":
												$this->section_stack[count($this->section_stack)-1][start] = $this->replace_data_variables($value, $data);
												break;
											case "end":
												$this->section_stack[count($this->section_stack)-1][end] = $this->replace_data_variables($value, $data);
												break;
											case "max":
												$value = $this->replace_data_variables($value, $data);
												if ($value < 1) $this->errorMsg("max 인자는 1보다 작을 수 없습니다.");
												$this->section_stack[count($this->section_stack)-1][max] = $value;
												break;
											case "step":
												$this->section_stack[count($this->section_stack)-1][step] = $this->replace_data_variables($value, $data);
												break;
										}
									}
									//start 가 없으면 1로 자동 setting한다.
									if (empty($this->section_stack[count($this->section_stack)-1][start])) {
										$this->section_stack[count($this->section_stack)-1][start] = 1;
									}

									//end가 없는 경우는 0으로 setting하며 end에 대한 조건을 걸지 않도록 한다.
									if (empty($this->section_stack[count($this->section_stack)-1][end])) {
										$this->section_stack[count($this->section_stack)-1][end] = 0;
									}
		
									//max가 없는 경우는 0으로 setting하며 max에 대한 조건을 걸지 않도록 한다.
									if (empty($this->section_stack[count($this->section_stack)-1][max])) {
										$this->section_stack[count($this->section_stack)-1][max] = 0;
									}

									//step가 없는 경우는 1으로 setting한다.
									if (empty($this->section_stack[count($this->section_stack)-1][step])) {
										$this->section_stack[count($this->section_stack)-1][step] = 1;
									}

									//idx값을 start와 동일하게 세팅
									$this->section_stack[count($this->section_stack)-1][idx] = $this->section_stack[count($this->section_stack)-1][start];
		
									//count 세팅
									$this->section_stack[count($this->section_stack)-1][cnt] = 1;

									//idx값을 access할 수 있도록 internaldata hash 변수에 할당한다.
									$this->internaldata["_sidx"] = $this->section_stack[count($this->section_stack)-1][idx];
								} else {
									$this->errorMsg("section 문법 에러!");
								}
							} else {
								$this->section_stack[count($this->section_stack)-1][idx] = $this->section_stack[count($this->section_stack)-1][idx] + $this->section_stack[count($this->section_stack)-1][step];
								$this->section_stack[count($this->section_stack)-1][cnt]++;
							
								$this->internaldata["_sidx"] = $this->section_stack[count($this->section_stack)-1][idx];
							}
							if (($this->section_stack[count($this->section_stack)-1][end] != 0 && $this->section_stack[count($this->section_stack)-1][idx] > $this->section_stack[count($this->section_stack)-1][end]) || 
							($this->section_stack[count($this->section_stack)-1][cnt] > $this->section_stack[count($this->section_stack)-1][max] && $this->section_stack[count($this->section_stack)-1][max] != 0) || 
							($this->section_stack[count($this->section_stack)-1][idx] > $this->section_stack[count($this->section_stack)-1][data_count])) {
								$this->section_stack[count($this->section_stack)-1][active] = 0;
								if ($this->section_stack[count($this->section_stack)-1][end_point] != 0) {
									$i = $this->section_stack[count($this->section_stack)-1][end_point]-1;
									next;
								}
							} else {
								$this->section_stack[count($this->section_stack)-1][active] = 1;
							}
						} else if (preg_match("/^\\!endsection/", $token_each)) {
							$this->section_stack[count($this->section_stack)-1][end_point] = $i;

							if ($this->section_stack[count($this->section_stack)-1][active] == 1) {
								$i = $this->section_stack[count($this->section_stack)-1][start_point]-1;
								next;
							} else {
								array_pop($this->section_stack);
								if (count($this->section_stack) > 0) {
									$this->internaldata["_sidx"] = $this->section_stack[count($this->section_stack)-1][idx];
								} else {
									$this->internaldata["_sidx"] = $this->section_stack[count($this->section_stack)-1][idx];
								}
							}
						} else if (preg_match("/^\\!if/", $token_each)) {
						} else if (preg_match("/^\\!else/", $token_each)) {
						} else if (preg_match("/^\\!endif/", $token_each)) {
						} else {
							$this->errorMsg("Invalid ! Command! => [$token_each]");
						}
						$result = "";
					} else if (!empty($this->hashdata[$token_each])) { 
						$result = $this->parsing($data, $this->hashdata[$token_each]);
					} else {
						$result = "NOT MATCH! [$token_each]";
					}

					if ($option == 0) { 
						$this->rdata .= $result;
					} else {
						echo($result);
					}
				}
			} else {
				if ($add_flag == 1) {
					if ($option == 0) { 
						$this->rdata .= $tokens[$i];
					} else {
						echo($tokens[$i]);
					}
				}
			}
		}
		if (count($if_stack) != 0) {
			$this->errorMsg("incorrect if block!");
			$this->rdata = "";
		}
	}

	function display ($opt = "") {
		if($opt == 'ajax') {
			$this->rdata = iconv("EUC-KR","UTF-8",$this->rdata);
		}
		echo($this->rdata);
	}

	function returnResult() {
		return $this->rdata;
	}

	function replace_data_variables($template, $data, $opt = 0) {
		#modifed 1.11 - start
		$template .= " ";
		$cnt = 0;
		#modifed 1.11 - end

		while (preg_match("/\\\$([\\d\\w\\.\\>\\[\\]\\-\\_]+)/", $template, $matches)) {
			$matches[1] = preg_replace("/\\(/", '\\\(', $matches[1]);
			$matches[1] = preg_replace("/\\)/", '\\\)', $matches[1]);
			$matches[1] = preg_replace("/\\$/", '\\\$', $matches[1]);
			$matches[1] = preg_replace("/\\&/", '\\\&', $matches[1]);
			#modifed 1.14 - start
			if (preg_match("/^([^\\[^\\]^\\-^\\>]+?)\\.(.+)$/",$matches[1], $matches2)) {
			#modifed 1.14 - end
				//변수 이름을 사용할때 . 구분자를 사용하는 경우 hash type임을 판단한다.
				$search_form = $matches2[1];
				//다중 object를 지원하기 위해서 split함수로 나눈후에 재결합을 시킨다.
				$access_form_temp = split("\.", $matches2[2]);
				$access_form = "";
				for ($i=0;$i<count($access_form_temp);$i++) {
					$access_form .= "[\"".$access_form_temp[$i]."\"]";
				}
			#modifed 1.13 - start
			#modifed 1.14 - start
			} else if (preg_match("/^([^\\.^\\[^\\]]+?)\\-\\>(.+)$/",$matches[1], $matches2)) {
			#modifed 1.14 - end
				//변수 이름을 사용할때 . 구분자를 사용하는 경우 object type임을 판단한다. (배열의 OBJECT인 경우는 제외하도록 [와 ] 기호는 제외시킨다.
				$search_form = $matches2[1];
				//다중 object를 지원하기 위해서 split함수로 나눈후에 재결합을 시킨다.
				$access_form_temp = split("\\-\\>", $matches2[2]);
				$access_form = "";
				for ($i=0;$i<count($access_form_temp);$i++) {
					$access_form .= "->".$access_form_temp[$i];
				}
			#modifed 1.13 - end
			} else if (preg_match("/^([^\\[].+?)\\[(.+?)$/", $matches[1], $matches2)) {
				//배열의 경우 
				$search_form = $matches2[1];
				$access_form = "[".$matches2[2];
				//배열중에서 _sidx를 사용하는 경우는 section_stack에서 idx값을 읽어온 후에 이로 치환해야 한다.
				//section 변수를 치환할때 현재 section을 사용중이 아닌 경우는 그냥 0으로 반환해야 한다 - 2004.3.5
				$access_form = preg_replace("/\\[_sidx\\]/", "[".($this->section_stack[count($this->section_stack)-1][idx]-1)."]", $access_form);
			} else {
				$search_form = $matches[1];
				$access_form = "";
			}
			if (array_key_exists($search_form, $data)) {
				//주어진 데이터가 있는 경우는 해당 값으로 치환한다.
				$matches[1] = preg_replace("/\\[/", "\\[", $matches[1]);
				$matches[1] = preg_replace("/\\]/", "\\]", $matches[1]);
				#modified 1.06 - start
				#궁여지책으로 일단 accessw_form이 있는 경우는 에러를 무시하도록 한다.
				#해당 값이 NULL 혹은 0 일때 eval 문에서 에러가 나는 이유를 반드시 찾아야 한다 - 2003.8.29 종선
				if ($access_form == "") {
					eval("\$real_data = \"\$data[$search_form]$access_form\";");
				} else {
				#modified 1.05 - start
					eval("\$real_data = \$data[$search_form]$access_form;");
				#modified 1.05 - end
				}
				#modified 1.06 - end
				if ($opt == 1)  {
					#modified 1.11 - start
					#$l 과 $location 의 구분이 안되는 문제를 위해서 뒤에 공백을 반드시 주도록 설정하였다.
					#modified 1.12 - start
					#if문에서 ==를 붙여서 쓰는 경우도 감안하였다
					$real_data = preg_replace("/\"/", "\\\"", $real_data);
					$template = preg_replace("/\\\$$matches[1]([,) \"'\&\=\!]+)/", "\"".$real_data."\"\\1", $template); 
					#modified 1.12 - end
					#modified 1.11 - end
				} else {
					#modified 1.11 - start
					#$l 과 $location 의 구분이 안되는 문제를 위해서 뒤에 공백을 반드시 주도록 설정하였다.
					#modified 1.12 - start
					#if문에서 ==를 붙여서 쓰는 경우도 감안하였다
					$template = preg_replace("/\\\$$matches[1]([,) \"'\&\=\!]+)/", $real_data."\\1", $template);
					#modified 1.12 - end
					#modified 1.11 - end
				}
			} else {
				//주어진 데이터가 존재하지 않은 경우는 0으로 바꾼다.
				$template = preg_replace("/\\\$$matches[1]/", "0", $template);
			}
			#modifed 1.21 - start
			$cnt++;
			//opt 가 2일경우는 recursive하게 돌지 않는다.
			if ($opt == 2 && $cnt == 1) break;
			#modifed 1.21 - end
		}

		#내부변수 처리를 한다. - 버그 수정
		#modified 1.16 - start
		while (preg_match("/#(\\_[\\d\\w\\-\\_]+)/", $template, $matches)) {
			$template = preg_replace("/#$matches[1]/", $this->internaldata[$matches[1]], $template);
		}
		#modified 1.16 - end
		$template = trim($template);
		return $template;
	}

	function errorMsg($msg) {
		echo("Ghost Template Engine Error <b>[$msg]</b><br>");
		exit;
	}
}

function checkDataExist($token, $data) {
	if (preg_match("/^(.+?)\\./",$token, $matches)) {
		$token = $matches[1];
	} else if (preg_match("/^(.+?)\\[/", $token, $matches)) {
		$token = $matches[1];
	#modified 1.13 - start
	} else if (preg_match("/^(.+?)\\-/", $token, $matches)) {
		$token = $matches[1];
	#modified 1.13 - end
	}
	#modified 1.04 - start
	if (isset($data[$token])) { 
	#modified 1.04 - end
		return true;
	} else {
		return false;
	}
}

#modified 1.23 - start
function checkIfStatusIF ($if, $ifelse) {
	$pos = count($if)-1;
	#echo("###<br>");
	#for ($i=0;$i<=$pos;$i++) 
	#	echo("IF[$i] : ".$if[$i].", IFELSE[$i] :".$ifelse[$i]."<BR>");
	#echo("###<br>");
	for ($i=$pos-1;$i>=0;$i--) {
		if ($ifelse[$i] == 1) {
			if ($if[$i] == 0) {
				$tmp_status = 1;
			} else {
				$tmp_status = 0;
			}
		} else {
			$tmp_status = $if[$i];
		}
		if ($tmp_status == 0) return false;
	}
	return true;
}
#modified 1.23 - end
?>
