<?php
function word_filter_callback($m) {
  static $vals = array(
    'smh' => 'baka',
    'SMH' => 'BAKA',
    'tbh' => 'desu',
    'TBH' => 'DESU',
    'fam' => 'senpai',
    'FAM' => 'SENPAI',
    'Fam' => 'Senpai',
    'fams' => 'senpaitachi',
    'FAMS' => 'SENPAITACHI',
    'FAMs' => 'SENPAITACHI',
    'Fams' => 'Senpaitachi'
  );
  
  if (!isset($vals[$m[2]])) {
    return $m[0];
  }
  
  return "{$m[1]}{$vals[$m[2]]}{$m[3]}";
}

function word_filter_consoles($text) {
  static $from = array(
    'pcfat',
    'pcuck',
    'pccuck',
    'valvedrone',
    'sonynigger',
    'sonygger',
    'sonydrone',
    'sonycuck',
    'sonypony',
    'nintencuck',
    'nintoddler',
    'nintendotoddler',
    'nintendrone',
    'nintenyearold',
    'nintendroid',
    'nintenshit',
    'Pcfat',
    'Pcuck',
    'PCuck',
    'Pccuck',
    'Valvedrone',
    'Sonynigger',
    'Sonygger',
    'Sonydrone',
    'Sonycuck',
    'Sonypony',
    'Nintencuck',
    'Nintoddler',
    'Nintendotoddler',
    'Nintendrone',
    'Nintenyearold',
    'Nintendroid',
    'Nintenshit',
    'nintendr0ne',
    'Nintendr0ne',
    'sonybrony',
    'Sonybrony',
    'sonybronies',
    'Sonybronies',
    'sonypony',
    'Sonypony',
    'sonyponies',
    'Sonyponies',
    'sonigger',
    'Sonigger'
  );
  
  static $to = array(
    'pcbro',
    'pcbro',
    'pcbro',
    'pcbro',
    'sonybro',
    'sonybro',
    'sonybro',
    'sonybro',
    'sonybro',
    'nintenbro',
    'nintenbro',
    'nintenbro',
    'nintenbro',
    'nintenbro',
    'nintenbro',
    'nintenbro',
    'Pcbro',
    'Pcbro',
    'PCbro',
    'Pcbro',
    'Pcbro',
    'Sonybro',
    'Sonybro',
    'Sonybro',
    'Sonybro',
    'Sonybro',
    'Nintenbro',
    'Nintenbro',
    'Nintenbro',
    'Nintenbro',
    'Nintenbro',
    'Nintenbro',
    'Nintenbro',
    'nintenbro',
    'Nintenbro',
    'sonybro',
    'Sonybro',
    'sonybros',
    'Sonybros',
    'sonybro',
    'Sonybro',
    'sonybros',
    'Sonybros',
    'sonybro',
    'Sonybro'
  );
  
  return str_replace($from, $to, $text);
}

function word_filter_callback_soy($m) {
  $is_uc = $m[2] === strtoupper($m[2]);
  
  $lc = strtolower($m[4]);
  
  if ($lc === 'uz') {
    return $m[0];
  }
  
  if ($lc === 'im' || $lc === 'lent') {
    $m[4] = '';
  }
  
  if (!isset($m[4][1])) {
    if ($is_uc) {
      $onions = 'ONIONS';
    }
    else {
      if ($m[2][0] === 's') {
        $onions = 'onions';
      }
      else {
        $onions = 'Onions';
      }
    }
    
    return "{$m[1]}{$onions}{$m[4]}";
  }
  
  if ($m[2][0] === 's') {
    $b = 'b';
  }
  else {
    $b = 'B';
  }
  
  $ac = mb_strlen($m[3]);
  
  if ($ac == 1) {
    $a = 'a';
  }
  else {
    if ($ac < 35) {
      $a = str_repeat('a', $ac);
    }
    else {
      $a = 'a';
    }
  }
  
  $based = "{$b}{$a}sed";
  
  if ($is_uc) {
    $based = strtoupper($based);
  }
  
  return $m[1] . $based . $m[4];
}

// $text contents of a field
// $type name of the field
function word_filter($text, $type) {
  if ($type !== 'com') {
    return $text;
  }
  
//  $text = str_replace('Cuck', 'Kek', $text);
//  $text = str_replace('cuck', 'kek', $text);
  $text = str_replace('CUCK', 'KEK', $text);
  
  $text = preg_replace_callback('/(\b)(sjw|sjws|smh|tbh|fams|fam)(\b)/i', 'word_filter_callback', $text);
  
  $text = preg_replace_callback('/(\b)(s([o0οоօჿ]+)[yуΥ])(\b|[[:alpha:]]{2,4})/iu', 'word_filter_callback_soy', $text);
  
  $text = word_filter_consoles($text);
  
  return $text;
}
