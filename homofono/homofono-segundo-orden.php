<?php
// Alfabeto homofónico
$alfabetoHomofonico = array(
'A' =>[413, 523, 131, 309, 643, 133, 304, 334, 229, 414, 85, 211, 234, 41, 530, 104, 27, 729, 516, 513, 39, 373, 703, 318, 394, 555, 457],
'B' =>[76, 424, 161, 357, 2, 484, 15, 692, 59, 255, 144, 504, 716, 547, 207, 219, 122, 265, 726, 282, 83, 323, 256, 415, 295, 640, 712],
'C' =>[130, 101, 259, 160, 368, 189, 626, 624, 67, 169, 155, 184, 188, 238, 33, 403, 16, 443, 515, 460, 630, 683, 672, 270, 49, 361, 250],
'D' =>[493, 296, 608, 393, 34, 91, 57, 482, 483, 50, 665, 249, 610, 12, 631, 411, 656, 612, 174, 136, 321, 597, 704, 56, 23, 195, 52],
'E' =>[642, 496, 379, 277, 713, 308, 338, 125, 444, 349, 322, 398, 537, 722, 429, 718, 328, 550, 46, 548, 303, 230, 378, 215, 451, 35, 88],
'F' =>[320, 440, 629, 226, 126, 542, 291, 363, 682, 455, 635, 578, 430, 360, 267, 497, 118, 561, 81, 477, 685, 362, 383, 31, 365, 464, 371],
'G' =>[569, 213, 194, 724, 486, 556, 607, 532, 199, 75, 435, 591, 499, 684, 627, 307, 375, 289, 602, 242, 606, 158, 476, 728, 356, 408, 723],
'H' =>[204, 8, 467, 146, 21, 519, 695, 186, 507, 670, 143, 227, 123, 159, 317, 302, 241, 310, 36, 103, 80, 48, 370, 253, 701, 90, 641],
'I' =>[198, 725, 254, 666, 622, 333, 720, 106, 127, 152, 427, 540, 634, 44, 71, 392, 585, 680, 700, 639, 595, 674, 621, 290, 116, 348, 452],
'J' =>[20, 276, 66, 231, 502, 94, 514, 43, 491, 17, 24, 388, 382, 541, 711, 719, 154, 573, 258, 197, 586, 162, 574, 330, 445, 437, 648],
'K' =>[376, 100, 500, 98, 7, 441, 448, 200, 490, 203, 668, 293, 4, 173, 697, 86, 508, 9, 214, 539, 616, 472, 425, 667, 416, 506, 180],
'L' =>[614, 536, 557, 313, 182, 454, 442, 168, 571, 73, 60, 709, 575, 710, 148, 580, 232, 572, 341, 662, 332, 471, 521, 372, 419, 407, 593],
'M' =>[82, 669, 696, 404, 498, 120, 228, 439, 599, 671, 210, 655, 261, 707, 115, 601, 108, 478, 151, 474, 102, 525, 327, 558, 260, 251, 699],
'N' =>[679, 170, 512, 283, 450, 559, 74, 172, 212, 38, 562, 167, 19, 459, 243, 649, 164, 262, 522, 245, 380, 654, 315, 717, 268, 590, 381],
'Ñ' =>[233, 221, 554, 470, 422, 329, 617, 533, 209, 589, 377, 546, 686, 354, 138, 14, 473, 475, 456, 647, 390, 657, 694, 421, 298, 604, 68],
'O' =>[517, 285, 582, 479, 600, 78, 149, 163, 10, 449, 1, 618, 446, 576, 339, 615, 623, 628, 114, 223, 109, 306, 526, 721, 135, 485, 113],
'P' =>[222, 63, 678, 577, 538, 434, 417, 273, 292, 202, 596, 312, 29, 463, 625, 32, 252, 134, 661, 301, 55, 609, 632, 432, 294, 61, 87],
'Q' =>[22, 337, 423, 326, 11, 594, 658, 218, 603, 653, 652, 620, 568, 412, 340, 331, 355, 501, 518, 266, 240, 431, 510, 492, 65, 369, 25],
'R' =>[714, 54, 664, 225, 462, 399, 224, 336, 132, 206, 645, 343, 95, 84, 391, 142, 660, 286, 698, 480, 613, 111, 545, 156, 651, 527, 663],
'S' =>[311, 335, 89, 208, 18, 702, 359, 689, 690, 579, 42, 428, 436, 529, 374, 272, 316, 386, 619, 433, 509, 181, 297, 248, 588, 693, 461],
'T' =>[384, 64, 396, 650, 367, 584, 147, 564, 165, 637, 37, 366, 611, 469, 494, 409, 688, 193, 107, 45, 5, 175, 675, 481, 30, 402, 96],
'U' =>[534, 217, 51, 166, 3, 271, 395, 644, 551, 715, 325, 139, 119, 358, 705, 192, 145, 239, 72, 278, 187, 633, 79, 400, 157, 40, 691],
'V' =>[185, 389, 324, 351, 183, 570, 287, 216, 288, 505, 676, 205, 438, 141, 646, 543, 191, 13, 28, 300, 190, 269, 137, 346, 220, 110, 97],
'W' =>[257, 528, 344, 77, 352, 305, 280, 587, 129, 544, 235, 420, 405, 565, 69, 466, 93, 176, 124, 418, 453, 553, 706, 247, 178, 489, 121],
'X' =>[58, 299, 92, 727, 605, 62, 263, 26, 117, 495, 244, 353, 140, 567, 70, 284, 687, 47, 246, 319, 364, 549, 511, 53, 563, 345, 636],
'Y' =>[566, 560, 397, 488, 264, 673, 401, 638, 342, 535, 153, 681, 458, 598, 677, 708, 236, 171, 105, 503, 314, 99, 426, 659, 447, 465, 150],
'Z' =>[237, 385, 487, 6, 128, 468, 279, 583, 201, 350, 274, 281, 406, 387, 410, 581, 531, 179, 196, 524, 177, 112, 552, 275, 347, 592, 520]
);

// Mensaje y clave deben de tener la misma longitud
function cifrarMensaje($mensaje, $clave) {
    global $alfabetoHomofonico;
    $mensajeCifrado = " ";
    $clave=trim($clave);
    $mensaje=trim($mensaje);

    foreach (str_split($mensaje) as $index => $letra) {
        $letraMayuscula = strtoupper($letra);
        if (array_key_exists($letraMayuscula, $alfabetoHomofonico)) {
            $posicionLetraClave= array_search($clave[$index],array_keys($alfabetoHomofonico));
            $simbolos = $alfabetoHomofonico[$letraMayuscula];
            $simboloCifrado = $simbolos[$posicionLetraClave];
            $mensajeCifrado .= $simboloCifrado . " ";
        } else {
            if (!empty($letra) && $letra!==" "){
                $mensajeCifrado .= $letra . " ";
            }
        }
    }

    return trim($mensajeCifrado);
}

function descifrarMensaje($mensajeCifrado, $clave) {
    global $alfabetoHomofonico;
    $mensajeDescifrado = '';
    $clave=str_replace(' ', '', $clave);
    $mensajeCifrado=trim($mensajeCifrado);

    foreach (explode(" ", $mensajeCifrado) as $index=>$simboloCifrado) {
        $letraEncontrada = false;
        $posicionLetraClave= array_search($clave[$index],array_keys($alfabetoHomofonico));
        foreach ($alfabetoHomofonico as $letra => $simbolos) {
            if (strval($simbolos[$posicionLetraClave])===$simboloCifrado) {
                $mensajeDescifrado .= $letra;
                $letraEncontrada = true;
                break;
            }
        }

        if (!$letraEncontrada) {
            $mensajeDescifrado .= $simboloCifrado;
        }
    }

    return $mensajeDescifrado;
}
$mensajeOriginal = 'BAJA ME LA JAULA JAIME';
$clave = 'BAJA ME LA JAULA JAIME';

$mensajeCifrado = cifrarMensaje($mensajeOriginal, $clave);
echo 'Mensaje cifrado: ' . $mensajeCifrado . '<br>';

$mensajeDescifrado = descifrarMensaje($mensajeCifrado, $clave);
echo 'Mensaje descifrado: ' . $mensajeDescifrado . '<br>';
