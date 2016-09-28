<?php
 global $IXAP447; $IXAP447 = null; function fake_bcadd( $IXAP448, $IXAP449, $IXAP450 = null ) { return fake_bcmath_scale( ( string ) ( doubleval( $IXAP448 ) + doubleval( $IXAP449 ) ), $IXAP450 ); } function fake_bccomp( $IXAP448, $IXAP449, $IXAP450 = null ) { $IXAP451 = doubleval( fake_bcmath_scale( $IXAP448, $IXAP450 ) ); $IXAP452 = doubleval( fake_bcmath_scale( $IXAP449, $IXAP450 ) ); $IXAP453 = 0; if ( $IXAP451 < $IXAP452 ) { $IXAP453 = -1; } else if ( $IXAP451 > $IXAP452 ) { $IXAP453 = 1; } return $IXAP453; } function fake_bcdiv( $IXAP448, $IXAP449, $IXAP450 = null ) { return fake_bcmath_scale( ( string ) ( doubleval( $IXAP448 ) / doubleval( $IXAP449 ) ), $IXAP450 ); } function fake_bcmod( $IXAP448, $IXAP454 ) { return ( string ) ( intval( $IXAP448 ) % intval( $IXAP454 ) ); } function fake_bcmul( $IXAP448, $IXAP449, $IXAP450 = null ) { return fake_bcmath_scale( ( string ) ( doubleval( $IXAP448 ) * doubleval( $IXAP449 ) ), $IXAP450 ); } function fake_bcpow( $IXAP448, $IXAP449, $IXAP450 = null ) { return fake_bcmath_scale( ( string ) ( pow( doubleval( $IXAP448 ), doubleval( $IXAP449 ) ) ), $IXAP450 ); } function fake_bcpowmod( $IXAP448 , $IXAP449 , $IXAP454, $IXAP450 = null ) { if ( $IXAP454 == 0 ) { $IXAP455 = null; } else { $IXAP455 = fake_bcmath_scale( ( string ) ( pow( doubleval( $IXAP448 ), doubleval( $IXAP449 ) ) % intval( $IXAP454 ) ), $IXAP450 ); } return $IXAP455; } function fake_bcscale( $IXAP450 ) { global $IXAP447; $IXAP74 = intval( $IXAP450 ); if ( $IXAP74 >= 0 ) { $IXAP447 = $IXAP74; return true; } else { return false; } } function fake_bcsqrt( $IXAP456, $IXAP450 = null ) { return fake_bcmath_scale( ( string ) sqrt( doubleval( $IXAP456 ) ), $IXAP450 ); } function fake_bcsub( $IXAP448, $IXAP449, $IXAP450 = null ) { return fake_bcmath_scale( ( string ) ( doubleval( $IXAP448 ) - doubleval( $IXAP449 ) ), $IXAP450 ); } function fake_bcmath_scale( $IXAP87, $IXAP450 = null ) { global $IXAP447; $IXAP74 = null; if ( $IXAP450 !== null ) { $IXAP74 = intval( $IXAP450 ); } else if ( $IXAP447 !== null ) { $IXAP74 = intval( $IXAP447 ); } if ( $IXAP74 !== null ) { return ( string ) round( doubleval( $IXAP87 ), $IXAP74 ); } else { return $IXAP87; } } if ( !function_exists( 'bcadd' ) ) { function bcadd( $IXAP448, $IXAP449, $IXAP450 = null ) { return fake_bcadd( $IXAP448, $IXAP449, $IXAP450 ); } function bccomp( $IXAP448, $IXAP449, $IXAP450 = null ) { return fake_bccomp( $IXAP448, $IXAP449, $IXAP450 ); } function bcdiv( $IXAP448, $IXAP449, $IXAP450 = null ) { return fake_bcdiv($IXAP448, $IXAP449, $IXAP450 ); } function bcmod( $IXAP448, $IXAP454 ) { return fake_bcmod( $IXAP448, $IXAP454 ); } function bcmul( $IXAP448, $IXAP449, $IXAP450 = null ) { return fake_bcmul( $IXAP448, $IXAP449, $IXAP450 ); } function bcpow( $IXAP448, $IXAP449, $IXAP450 = null ) { return fake_bcpow($IXAP448, $IXAP449, $IXAP450 ); } function bcpowmod( $IXAP448 , $IXAP449 , $IXAP454, $IXAP450 = null ) { return fake_bcpowmod($IXAP448, $IXAP449, $IXAP454, $IXAP450 ); } function bcscale( $IXAP450 ) { return fake_bcscale( $IXAP450 ); } function bcsqrt( $IXAP456, $IXAP450 = null ) { return fake_bcsqrt( $IXAP456, $IXAP450 ); } function bcsub( $IXAP448, $IXAP449, $IXAP450 = null ) { return fake_bcsub( $IXAP448, $IXAP449, $IXAP450 ); } } 