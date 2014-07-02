<?php

namespace LFSM\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LFSM\AdminBundle\Entity\ExcelFileImport;
use LFSM\AdminBundle\Form\ExcelFileImportType;
use LFSM\AdminBundle\Form\MappingCSVType;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use LFSM\ToolBundle\Entity\Tools;

/**
 * ExcelFileImport controller.
 *
 * @Route("/excelfileimport")
 */
class ExcelFileImportController extends Controller
{
    /**
     * Displays a form to edit an existing ExcelFileImport entity.
     *
     * @Route("/{id}/edit", name="excelfile_import_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMAdminBundle:ExcelFileImport')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ExcelFileImport entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a ExcelFileImport entity.
    *
    * @param ExcelFileImport $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ExcelFileImport $entity)
    {
        $form = $this->createForm(new ExcelFileImportType(), $entity, array(
            'action' => $this->generateUrl('excelfile_import_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    
    /**
     * Edits an existing ExcelFileImport entity.
     *
     * @Route("/{id}", name="excelfile_import_update")
     * @Method("PUT")
     * @Template("LFSMAdminBundle:ExcelFileImport:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMAdminBundle:ExcelFileImport')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ExcelFileImport entity.');
        }

        $editForm = $this->createEditForm($entity);
        
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $fileValueForm = $editForm->getData()->file;

            if (!empty($fileValueForm)) {
                $entity->uploadFile();
                $em->flush();
                
                return $this->redirect($this->generateUrl('excelfile_import_mapping'));
            }
            else{
                $this->get('session')->getFlashBag()->add('error', 'Vous devez enregistrer un fichier. Reessayez s\'il vous plait.');
                return array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                );
            }
        }
    }
    
    /**
     * Mapping of csv fields with database
     *
     * @Route("/excelfile-import-mapping/{error}", name="excelfile_import_mapping")
     * @Route("/excelfile-import-mapping")
     * @Template("LFSMAdminBundle:ExcelFileImport:mapping.html.twig")
     */
    public function importMappingExcelFileAction(Request $request, $error = null)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->get('session');
        
        $entity = $em->getRepository('LFSMAdminBundle:ExcelFileImport')->find(1);
        
        $headers = $entity->parseExcelFileHeader($em, dirname($this->get('kernel')->getRootDir()));
                
        if (false != $headers){
            if ('error' != $error){
                $session->getFlashBag()->add('success', 'Votre '
                    . 'fichier a correctement été uploadé. Veuillez à présent '
                    . 'mapper les données avec les listes déroulantes ci dessous '
                    . 's\'il vous plait.');
            }

            $csvMappingForm = $this->createForm(new MappingCSVType($headers));

            return array(
                'csvMappingForm' => $csvMappingForm->createView()
            );
        }
        else {
            $this->get('session')->getFlashBag()->add('error', 'Votre fichier ne comporte pas de première ligne avec des champs. Reessayez s\'il vous plait.');
            return $this->redirect($this->generateUrl('excelfile_import_edit', array('id' => 1)));
        }
    }
    
     /**
     * Mapping of csv fields with database
     *
     * @Route("/excelfile-import-treatment", name="excelfile_import_treatment")
     * @Template("LFSMAdminBundle:ExcelFileImport:treatment.html.twig")
     */
    public function treatMappedExcelData(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $this->get('session');
        $a_dataForm = current($request->request->all());
        
        unset ($a_dataForm['_token']);
        $a_checkedData = ExcelFileImport::checkMappingDatas($a_dataForm);
        
        if (!empty($a_checkedData)){
           $session->getFlashBag()->add('error', 'La correspondance des champs a échoué. Il est possible que votre fichier comporte des erreurs (champs manquants).');
           $session->getFlashBag()->add('error', 'Les données suivantes n\'ont pas été mappées: ' . implode(', ', $a_checkedData) . '.');
           $session->getFlashBag()->add('error', 'Veuillez recommencer le mappage ou cliquer sur l\'icone du menu pour enregistrer un fichier valide.');
           
           return $this->redirect(($this->generateUrl('excelfile_import_mapping', array('error' => 'error'))));
        }
        else {
            $cleanData = ExcelFileImport::cleanData($a_dataForm);
            $excelFileImport = new ExcelFileImport();
            $csv_file = $excelFileImport->getCsvFilenamePath($em, dirname($this->get('kernel')->getRootDir()));
            $a_data = Tools::parse_csv_file($cleanData, $csv_file, true, ",");

            $b_resultImport = $excelFileImport->insertValuesIntoDatabase($em, $a_data, $session);

            $em->flush();
            
            if ($b_resultImport){
                $message = 'Les donateurs ont bien été importés dans la base.';
            }
            else {
                $message = 'Aucun donateur n\'a été importé dans la base.';
            }
        }
        
        return array(
            'message' => $message
        );
    }
}
