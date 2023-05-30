<?php

namespace App\Outsourcing\Banorte\Payworks;

/**
 * ManualDeIntegracion_ComercioElectrónico_V2.1 (pág. 11, 26)
 * AUTH_RESULT/RESULTADO_AUT
 */
class CodigoAutorizadorPWS
{
    const CODIGO_APROBADO = '00';
	
	public static $codigos_mensajes = [
		'00' => 'Approval',
		'01' => 'Referral / Call issuer',
		'02' => 'Refer to issuer: special condition',
		'03' => 'Invalid merchant',
		'04' => 'Pick up card',
		'05' => 'Decline',
		'06' => 'Error',
		'07' => 'Reserved',
		'08' => 'Approved with positive ID',
		'09' => 'No action taken (unable to back out previous transaction)',
		'11' => 'Approval',
		'12' => 'Invalid transaction',
		'13' => 'Invalid amount',
		'14' => 'Invalid account number',
		'15' => 'No such issuer',
		'30' => 'System malfunction', 
		'31' => 'System malfunction',
		'33' => 'Expired card',
		'34' => 'Pick up card: special condition',
		'35' => 'Pick up card: special condition',
		'36' => 'Error',
		'37' => 'Pick up card: special condition',
		'38' => 'Allowable number of PIN entry retries exceeded',
		'39' => 'No savings account',
		'41' => 'Lost card',
		'43' => 'Pick up card (stolen card)',
		'51' => 'Not sufficient funds',
		'54' => 'Expired card',
		'55' => 'Incorrect PIN',
		'56' => 'Unable to locate record in file or account is missing',
		'57' => 'Transaction not permitted to cardholder',
		'58' => 'Transaction not permitted to cardholder',
		'59' => 'Required authorization code CVV2/CVC2 was not supplied',
		'61' => 'Withdrawal amount exceeds activity limit',
		'62' => 'Restricted card',
		'65' => 'Activity count limit exceeded',
		'68' => 'System malfunction',
		'75' => 'Allowable number of PIN entry retries exceeded',
		'76' => 'Reserved',
		'77' => 'Reserved',
		'78' => 'Reserved',
		'79' => 'Reserved',
		'81' => 'Reserved',
		'82' => 'Security violation',
		'83' => 'Reserved',
		'84' => 'Reserved',
		'85' => 'Reserved',
		'86' => 'Reserved',
		'87' => 'Reserved',
		'88' => 'Reserved',
		'89' => 'Reserved',
		'90' => 'Host not available',
		'91' => 'Host not available',
		'92' => 'Decline/Not reply/No such host/Invalid category',
		'94' => 'No action taken (unable to back out previous transaction)',
		'96' => 'System malfunction',
		'N0' => 'Reserved',
		'N1' => 'Reserved',
		'N2' => 'Reserved',
		'N3' => 'Reserved',
		'N4' => 'Reserved',
		'N5' => 'Reserved',
		'N6' => 'Reserved',
		'N7' => 'Reserved',
		'N8' => 'Reserved',
		'N9' => 'Reserved',
		'O0' => 'Reserved',
		'O1' => 'Reserved',
		'O2' => 'Reserved',
		'O3' => 'Reserved',
		'O4' => 'Reserved',
		'O5' => 'Reserved',
		'O6' => 'Reserved',
		'O7' => 'Reserved',
		'O8' => 'Reserved',
		'O9' => 'Reserved',
		'P0' => 'Reserved',
		'P1' => 'Reserved',
		'P2' => 'Reserved',
		'P3' => 'Reserved',
		'P4' => 'Reserved',
		'P5' => 'Reserved',
		'P6' => 'Reserved',
		'P7' => 'Reserved',
		'P8' => 'Reserved',
		'P9' => 'Reserved',
		'Q0' => 'Reserved',
		'Q1' => 'Reserved',
		'Q2' => 'Reserved',
		'Q3' => 'Reserved',
		'Q4' => 'Reserved', 
		'Q5' => 'Reserved',
		'Q6' => 'Reserved',
		'Q7' => 'Reserved',
		'Q8' => 'Reserved',
		'Q9' => 'Reserved',
		'R0' => 'Reserved',
		'R1' => 'Reserved',
		'R2' => 'Reserved',
		'R3' => 'Reserved',
		'R4' => 'Reserved',
		'R5' => 'Reserved',
		'R6' => 'Reserved',
		'R7' => 'Reserved',
		'R8' => 'Reserved',
		'S4' => 'Reserved',
		'S5' => 'Error',
		'S6' => 'Reserved',
		'S7' => 'Reserved',
		'S8' => 'No such record', 
		'S9' => 'Reserved', 
		'T1' => 'Reserved',
		'T2' => 'Reserved',
		'T3' => 'Reserved',
		'T4' => 'Reserved',
		'T5' => 'Reserved',
		'T6' => 'Reserved',
		'T7' => 'Reserved',
	];
	
	public $codigo;

	public function __construct($codigo)
	{
		$this->codigo = $codigo;
	}	
	
	public function existe()
	{
		return array_key_exists($this->codigo, self::$codigos_mensajes);
	}

    public function mensaje()
    {
        return self::existe($this->codigo) ? self::$codigos_mensajes[$this->codigo] : null;
    }

    public function estaAprobado()
    {
        return self::CODIGO_APROBADO == $this->codigo;
    }
}

/*

AUTH_RESULT / RESULTADO_AUT NOMBRE INGLES

00 Approval
01 Referral / Call issuer
02 Refer to issuer: special condition
03 Invalid merchant
04 Pick up card
05 Decline
06 Error
07 Reserved
08 Approved with positive ID
09 No action taken (unable to back out previous transaction)
11 Approval
12 Invalid transaction
13 Invalid amount
14 Invalid account number
15 No such issuer
30 System malfunction
31 System malfunction
33 Expired card
34 Pick up card: special condition
35 Pick up card: special condition
36 Error
37 Pick up card: special condition
38 Allowable number of PIN entry retries exceeded
39 No savings account
41 Lost card
43 Pick up card (stolen card)
51 Not sufficient funds
54 Expired card
55 Incorrect PIN
56 Unable to locate record in file or account is missing
57 Transaction not permitted to cardholder
58 Transaction not permitted to cardholder
59 Required authorization code CVV2/CVC2 was not supplied
61 Withdrawal amount exceeds activity limit
62 Restricted card
65 Activity count limit exceeded
68 System malfunction
75 Allowable number of PIN entry retries exceeded
76 Reserved
77 Reserved
78 Reserved
79 Reserved
81 Reserved
82 Security violation
83 Reserved
84 Reserved
85 Reserved
86 Reserved
87 Reserved
88 Reserved
89 Reserved
90 Host not available
91 Host not available
92 Decline/Not reply/No such host/Invalid category
94 No action taken (unable to back out previous transaction)
96 System malfunction
N0 Reserved
N1 Reserved
N2 Reserved
N3 Reserved
N4 Reserved
N5 Reserved
N6 Reserved
N7 Reserved
N8 Reserved
N9 Reserved
O0 Reserved
O1 Reserved
O2 Reserved
O3 Reserved
O4 Reserved
O5 Reserved
O6 Reserved
O7 Reserved
O8 Reserved
O9 Reserved
P0 Reserved
P1 Reserved
P2 Reserved
P3 Reserved
P4 Reserved
P5 Reserved
P6 Reserved
P7 Reserved
P8 Reserved
P9 Reserved
Q0 Reserved
Q1 Reserved
Q2 Reserved
Q3 Reserved
Q4 Reserved
Q5 Reserved
Q6 Reserved
Q7 Reserved
Q8 Reserved
Q9 Reserved
R0 Reserved
R1 Reserved
R2 Reserved
R3 Reserved
R4 Reserved
R5 Reserved
R6 Reserved
R7 Reserved
R8 Reserved
S4 Reserved
S5 Error
S6 Reserved
S7 Reserved
S8 No such record
S9 Reserved
T1 Reserved
T2 Reserved
T3 Reserved
T4 Reserved
T5 Reserved
T6 Reserved
T7 Reserved

*/
