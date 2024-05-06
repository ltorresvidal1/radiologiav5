<?php

namespace App\Http\Controllers\zip;

use ZipArchive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DescargarCdController extends Controller
{
  public function downloadZip()
  {



    /*

    
  





 

      $zip->close();
    }


    $headers = array('Content-Type' => 'application/octet-stream',);
    $filetopath = $public_dir . '/' . $zipFileName;
    //if(file_exists($filetopath)){
    return response()->download($filetopath, $zipFileName, $headers);
    //}
    //return['status'=>'file does not exist'];
*/

    $zip = new ZipArchive();
    $zipFileName = 'CD.zip';
    $zipFilePath = storage_path('app/' . $zipFileName);

    if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
      // Agrega los archivos al archivo zip (como se muestra en el ejemplo anterior)
      $zip->addEmptyDir('weasis');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/docking-frames-1.1.2-P20c.jar.pack.gz', 'weasis/bundle/docking-frames-1.1.2-P20c.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/javax.json-1.0.4.jar.pack.gz', 'weasis/bundle/javax.json-1.0.4.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/org.apache.felix.bundlerepository-2.0.10.jar.pack.gz', 'weasis/bundle/org.apache.felix.bundlerepository-2.0.10.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/org.apache.felix.configadmin-1.9.4.jar.pack.gz', 'weasis/bundle/org.apache.felix.configadmin-1.9.4.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/org.apache.felix.gogo.command-1.0.2.jar.pack.gz', 'weasis/bundle/org.apache.felix.gogo.command-1.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/org.apache.felix.gogo.runtime-1.1.0.jar.pack.gz', 'weasis/bundle/org.apache.felix.gogo.runtime-1.1.0.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/org.apache.felix.gogo.shell-1.1.0.jar.pack.gz', 'weasis/bundle/org.apache.felix.gogo.shell-1.1.0.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/org.apache.felix.metatype-1.2.0.jar.pack.gz', 'weasis/bundle/org.apache.felix.metatype-1.2.0.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/org.apache.felix.prefs-1.1.0.jar.pack.gz', 'weasis/bundle/org.apache.felix.prefs-1.1.0.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/org.apache.felix.scr-2.1.6.jar.pack.gz', 'weasis/bundle/org.apache.felix.scr-2.1.6.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/org.apache.sling.commons.log-3.0.2-r3.jar.pack.gz', 'weasis/bundle/org.apache.sling.commons.log-3.0.2-r3.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/repository.xml', 'weasis/bundle/repository.xml');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/slf4j-api-1.7.25.jar.pack.gz', 'weasis/bundle/slf4j-api-1.7.25.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/vecmath-1.5.2.jar.pack.gz', 'weasis/bundle/vecmath-1.5.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-acquire-editor-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-acquire-editor-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-acquire-explorer-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-acquire-explorer-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-base-explorer-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-base-explorer-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-base-ui-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-base-ui-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-base-viewer2d-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-base-viewer2d-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-core-api-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-core-api-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-core-ui-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-core-ui-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-dicom-au-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-dicom-au-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-dicom-codec-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-dicom-codec-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-dicom-explorer-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-dicom-explorer-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-dicom-qr-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-dicom-qr-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-dicom-send-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-dicom-send-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-dicom-sr-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-dicom-sr-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-dicom-viewer2d-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-dicom-viewer2d-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-dicom-wave-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-dicom-wave-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-imageio-codec-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-imageio-codec-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-opencv-core-3.0.2.jar.pack.gz', 'weasis/bundle/weasis-opencv-core-3.0.2.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-opencv-core-linux-x86-4.0.0-dcmR1.jar', 'weasis/bundle/weasis-opencv-core-linux-x86-4.0.0-dcmR1.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-opencv-core-linux-x86-64-4.0.0-dcmR1.jar', 'weasis/bundle/weasis-opencv-core-linux-x86-64-4.0.0-dcmR1.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-opencv-core-macosx-x86-64-4.0.0-dcmR1.jar', 'weasis/bundle/weasis-opencv-core-macosx-x86-64-4.0.0-dcmR1.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-opencv-core-windows-x86-4.0.0-dcmR1.jar', 'weasis/bundle/weasis-opencv-core-windows-x86-4.0.0-dcmR1.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle/weasis-opencv-core-windows-x86-64-4.0.0-dcmR1.jar', 'weasis/bundle/weasis-opencv-core-windows-x86-64-4.0.0-dcmR1.jar');

      $zip->addFile(storage_path() . '/app/cd/weasis/bundle-i18n/buildNumber.properties', 'weasis/bundle-i18n/buildNumber.properties');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle-i18n/Readme.txt', 'weasis/bundle-i18n/Readme.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle-i18n/weasis-acquire-editor-i18n-2.0.0.jar', 'weasis/bundle-i18n/weasis-acquire-editor-i18n-2.0.0.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle-i18n/weasis-acquire-explorer-i18n-2.0.0.jar', 'weasis/bundle-i18n/weasis-acquire-explorer-i18n-2.0.0.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle-i18n/weasis-base-explorer-i18n-2.0.0.jar', 'weasis/bundle-i18n/weasis-base-explorer-i18n-2.0.0.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle-i18n/weasis-base-ui-i18n-2.0.0.jar', 'weasis/bundle-i18n/weasis-base-ui-i18n-2.0.0.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle-i18n/weasis-base-viewer2d-i18n-2.0.0.jar', 'weasis/bundle-i18n/weasis-base-viewer2d-i18n-2.0.0.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle-i18n/weasis-core-api-i18n-2.0.0.jar', 'weasis/bundle-i18n/weasis-core-api-i18n-2.0.0.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle-i18n/weasis-core-ui-i18n-2.0.0.jar', 'weasis/bundle-i18n/weasis-core-ui-i18n-2.0.0.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle-i18n/weasis-dicom-au-i18n-2.0.0.jar', 'weasis/bundle-i18n/weasis-dicom-au-i18n-2.0.0.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle-i18n/weasis-dicom-codec-i18n-2.0.0.jar', 'weasis/bundle-i18n/weasis-dicom-codec-i18n-2.0.0.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle-i18n/weasis-dicom-explorer-i18n-2.0.0.jar', 'weasis/bundle-i18n/weasis-dicom-explorer-i18n-2.0.0.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle-i18n/weasis-dicom-qr-i18n-2.0.0.jar', 'weasis/bundle-i18n/weasis-dicom-qr-i18n-2.0.0.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle-i18n/weasis-dicom-send-i18n-2.0.0.jar', 'weasis/bundle-i18n/weasis-dicom-send-i18n-2.0.0.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle-i18n/weasis-dicom-sr-i18n-2.0.0.jar', 'weasis/bundle-i18n/weasis-dicom-sr-i18n-2.0.0.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/bundle-i18n/weasis-dicom-viewer2d-i18n-2.0.0.jar', 'weasis/bundle-i18n/weasis-dicom-viewer2d-i18n-2.0.0.jar');

      $zip->addFile(storage_path() . '/app/cd/weasis/conf/config.properties', 'weasis/conf/config.properties');
      $zip->addFile(storage_path() . '/app/cd/weasis/conf/ext-config.properties', 'weasis/conf/ext-config.properties');
      $zip->addFile(storage_path() . '/app/cd/weasis/conf/ext-dicomizer.properties', 'weasis/conf/ext-dicomizer.properties');


      $zip->addFile(storage_path() . '/app/cd/weasis/resources/images/about.png', 'weasis/resources/images/about.png');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/images/logo-button.png', 'weasis/resources/images/logo-button.png');

      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Cardiac.txt', 'weasis/resources/luts/Cardiac.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Fire.txt', 'weasis/resources/luts/Fire.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Flow.txt', 'weasis/resources/luts/Flow.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/GE Color.txt', 'weasis/resources/luts/GE Color.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Gray Rainbow.txt', 'weasis/resources/luts/Gray Rainbow.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Hot Green.txt', 'weasis/resources/luts/Hot Green.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Hot Iron.txt', 'weasis/resources/luts/Hot Iron.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Hot Metal.txt', 'weasis/resources/luts/Hot Metal.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Hue 1.txt', 'weasis/resources/luts/Hue 1.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Hue 2.txt', 'weasis/resources/luts/Hue 2.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Ice.txt', 'weasis/resources/luts/Ice.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Ired.txt', 'weasis/resources/luts/Ired.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/NIH.txt', 'weasis/resources/luts/NIH.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Rainbow 1.txt', 'weasis/resources/luts/Rainbow 1.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Rainbow 2.txt', 'weasis/resources/luts/Rainbow 2.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Rainbow 3.txt', 'weasis/resources/luts/Rainbow 3.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Rainbow 4.txt', 'weasis/resources/luts/Rainbow 4.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Rainbow 5.txt', 'weasis/resources/luts/Rainbow 5.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Ratio.txt', 'weasis/resources/luts/Ratio.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Spectrum.txt', 'weasis/resources/luts/Spectrum.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Stern.txt', 'weasis/resources/luts/Stern.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/Ucla.txt', 'weasis/resources/luts/Ucla.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/VR Bones.txt', 'weasis/resources/luts/VR Bones.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/VR Muscles-Bones.txt', 'weasis/resources/luts/VR Muscles-Bones.txt');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/luts/VR Red Vessels.txt', 'weasis/resources/luts/VR Red Vessels.txt');

      $zip->addFile(storage_path() . '/app/cd/weasis/resources/attributes-view.xml', 'weasis/resources/attributes-view.xml');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/dicomCallingNodes.xml', 'weasis/resources/dicomCallingNodes.xml');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/presets.xml', 'weasis/resources/presets.xml');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/series-splitting-rules.xml', 'weasis/resources/series-splitting-rules.xml');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources/store-tcs.properties.sample', 'weasis/resources/store-tcs.properties.sample');

      $zip->addFile(storage_path() . '/app/cd/weasis/felix.jar', 'weasis/felix.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/felix.jar.pack.gz', 'weasis/felix.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/resources.zip', 'weasis/resources.zip');
      $zip->addFile(storage_path() . '/app/cd/weasis/substance.jar', 'weasis/substance.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/substance.jar.pack.gz', 'weasis/substance.jar.pack.gz');
      $zip->addFile(storage_path() . '/app/cd/weasis/weasis-launcher.jar', 'weasis/weasis-launcher.jar');
      $zip->addFile(storage_path() . '/app/cd/weasis/weasis-launcher.jar.pack.gz', 'weasis/weasis-launcher.jar.pack.gz');


      $zip->addFile(storage_path() . '/app/cd/Autorun.inf', 'Autorun.inf');
      $zip->addFile(storage_path() . '/app/cd/Licence.txt', 'Licence.txt');
      $zip->addFile(storage_path() . '/app/cd/Readme.txt', 'Readme.txt');
      $zip->addFile(storage_path() . '/app/cd/viewer-linux.sh', 'viewer-linux.sh');
      $zip->addFile(storage_path() . '/app/cd/viewer-win32.exe', 'viewer-win32.exe');
      $zip->addFile(storage_path() . '/app/cd/viewer-win32.l4j.ini', 'viewer-win32.l4j.ini');

      $zip->addEmptyDir('DICOM');

      //$zip->addEmptyDir('viewer-mac.app');
      // $zip->addEmptyDir('viewer-mac.app/Contents');
      //$zip->addEmptyDir('viewer-mac.app/Resources');
      //$zip->addFile(storage_path() . '/app/cd/viewer-mac.app/Contents/Info.plist', 'Info.plist');
      //$zip->addFile(storage_path() . '/app/cd/DICOM', 'DICOM');


      //   $zip.folder("viewer-mac.app").folder("Contents").folder("MacOS").folder("failure.app").folder("Contents").folder("_CodeSignature").file("CodeResources", urlToPromise("/clases/cd/viewer-mac.app/Contents/MacOS/failure.app/Contents/_CodeSignature/CodeResources"), {binary:true});
      //  $zip.folder("viewer-mac.app").folder("Contents").folder("MacOS").folder("failure.app").folder("Contents").folder("MacOS").file("applet", urlToPromise("/clases/cd/viewer-mac.app/Contents/MacOS/failure.app/Contents/MacOS/applet"), {binary:true}); 

      //zip.folder("viewer-mac.app").folder("Contents").folder("MacOS").folder("failure.app").folder("Contents").folder("Resources").folder("description.rtfd").file("TXT.rtf", urlToPromise("/clases/cd/viewer-mac.app/Contents/MacOS/failure.app/Contents/Resources/description.rtfd/TXT.rtf"), {binary:true});
      //zip.folder("viewer-mac.app").folder("Contents").folder("MacOS").folder("failure.app").folder("Contents").folder("Resources").folder("Scripts").file("main.scpt", urlToPromise("/clases/cd/viewer-mac.app/Contents/MacOS/failure.app/Contents/Resources/Scripts/main.scpt"), {binary:true}); 
      //zip.folder("viewer-mac.app").folder("Contents").folder("MacOS").folder("failure.app").folder("Contents").folder("Resources").file("applet.icns", urlToPromise("/clases/cd/viewer-mac.app/Contents/MacOS/failure.app/Contents/Resources/applet.icns"), {binary:true});
      //zip.folder("viewer-mac.app").folder("Contents").folder("MacOS").folder("failure.app").folder("Contents").folder("Resources").file("applet.rsrc", urlToPromise("/clases/cd/viewer-mac.app/Contents/MacOS/failure.app/Contents/Resources/applet.rsrc"), {binary:true});


      //zip.folder("viewer-mac.app").folder("Contents").folder("MacOS").folder("failure.app").folder("Contents").file("Info.plist", urlToPromise("/clases/cd/viewer-mac.app/Contents/MacOS/failure.app/Contents/Info.plist"), {binary:true});
      //zip.folder("viewer-mac.app").folder("Contents").folder("MacOS").folder("failure.app").folder("Contents").file("PkgInfo", urlToPromise("/clases/cd/viewer-mac.app/Contents/MacOS/failure.app/Contents/PkgInfo"), {binary:true}); 

      //zip.folder("viewer-mac.app").folder("Contents").folder("MacOS").file("viewer-mac.sh", urlToPromise("/clases/cd/viewer-mac.app/Contents/MacOS/viewer-mac.sh"), {binary:true});
      //zip.folder("viewer-mac.app").folder("Contents").folder("Resources").file("logo-button.icns", urlToPromise("/clases/cd/viewer-mac.app/Contents/Resources/logo-button.icns"), {binary:true});
      //zip.folder("viewer-mac.app").folder("Contents").file("Info.plist", urlToPromise("/clases/cd/viewer-mac.app/Contents/Info.plist"), {binary:true});


      $zip->close();
    }

    // Envía la respuesta con el archivo zip adjunto
    return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
  }
}
