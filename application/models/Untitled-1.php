 // $assigner = $this->payment_model->getuserdatabyid($value['userId']);
                // $acceptedby = $this->payment_model->getuserdatabyid($value['uid_to']);
                // $natureofjob = $this->payment_model->getnatureofjobbyid($value['natureofjob']);
                $assigneruser  = nl2br($assigner[0]['salutation']." ".$assigner[0]['firstname']." ".$assigner[0]['lastname'] . "\n" . '<span style="color:#2bb3c0">'.$assigner[0]['mobile'] .'</span>');
                $acceptedbyuser  = nl2br($acceptedby[0]['salutation']." ".$acceptedby[0]['firstname']." ".$acceptedby[0]['lastname'] . "\n" . '<span style="color:#2bb3c0">'.$acceptedby[0]['mobile'] .'</span>');

                $servicecharge = (($value['totalamount'] * 5) / 100);
                $totalamount = $value['totalamount'] + $servicecharge + ((($value['totalamount'] + $servicecharge) * 18) / 100);

                $ser_chrg_recv_amnt = (($value['receivedamount'] * 5) / 100);
                $tot_recv_amnt = $value['totalamount'] + $servicecharge + ((($value['totalamount'] + $servicecharge) * 18) / 100);

                $data[] = array($value['aid'],
                                $value['paymentid'],
                                $assigneruser,
                                $acceptedbyuser,
                                $natureofjob,
                                nl2br($totalamount - (($totalamount*2)/100). "\n" . '<span style="color:#2bb3c0">Service Charge(5%): '.$servicecharge.'</span>'. "\n" . '<span style="color:#2bb3c0">GST (18%): '.((($value['totalamount'] + $servicecharge) * 18) / 100).'</span>'."\n".'<span style="color:#2bb3c0">Platform Fee (2%): '.(($totalamount*2)/100).'</span>'),

                                nl2br($totalamount - (($totalamount*2)/100). "\n" . '<span style="color:#2bb3c0">Service Charge(5%): '.$servicecharge.'</span>'. "\n" . '<span style="color:#2bb3c0">GST (18%): '.((($value['totalamount'] + $servicecharge) * 18) / 100).'</span>'."\n".'<span style="color:#2bb3c0">Platform Fee (2%): '.(($totalamount*2)/100).'</span>'),

                                $value['receivedamount'],
                                $value['balanceamount'],
                                );



                                