<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Http\Request;

use App\Repositories\KnowledgeThemeRepository;

use App\Repositories\KnowladgeHubRepository;

use App\Repositories\ArticleRepository;

use App\Repositories\DataSetRepository;

use App\Repositories\OtherKnowledgeRepository;


use App\Repositories\InfographicRepository;

use App\Repositories\LawAndRegulationRepository;
use App\Theme;
use App\Article;
use App\DataSet;
use App\OtherKnowladge;
use App\Infographic;
use App\LawAndRegulation;
use App\KnowladgeHub;
use App\KnowledgeTheme;


use App\Http\Requests\KnowladgeHubRequest;



use App\Rules\ExistRule;

use Session;

use EF;

use Crypt;


class KnowladgeHubController extends Controller
{
	
    public function index(Request $request)
    {
        try{
            if(isset($request->id))
            {
                $theme_id = decrypt($request->id);

                $knowledge_theme = new KnowledgeTheme;
    
                $knowledge_theme = $knowledge_theme->getKnowledgeThemeById($theme_id);

                if(isset($knowledge_theme->id))
                {

                $article = new Article;
        
                $data_set = new DataSet;
                $infographic = new Infographic;
                $law_and_regulation = new LawAndRegulation;
                $other_knowladge = new OtherKnowladge;
                $knowladge_hub = new KnowladgeHub;
                $theme_list = $knowledge_theme->getAllKnowledgeTheme();
                $article_list   = $article->getArticlesByThemeId($theme_id);

                $data_set_list   = $data_set->getDataSetsByThemeId($theme_id);
                $infographic_list   = $infographic->getInfographicsByThemeId($theme_id);

                $knowladge_hub_list   = $knowladge_hub->getKnowladgeByThemeId($theme_id);

                $law_and_regulation_list   = $law_and_regulation->getLawAndRegulationsByThemeId($theme_id);

                $training_knowledge_list    = $other_knowladge->getAllOtherKnowledgeByTypeId($theme_id,['Training Material']);
                $booklets_knowledge_list    = $other_knowladge->getAllOtherKnowledgeByTypeId($theme_id,['Booklets']);
                $posters_knowledge_list     = $other_knowladge->getAllOtherKnowledgeByTypeId($theme_id,['Posters / Leaflets']);
                $pamphlets_knowledge_list    = $other_knowladge->getAllOtherKnowledgeByTypeId($theme_id,['Pamphlets']);

                $view = view('knowledge_hub.component.theme_detail_component',[
        
                    'article_list'              => $article_list,
                    'data_set_list'             => $data_set_list,
                    'infographic_list'          => $infographic_list,
                    'knowladge_hub_list'        => $knowladge_hub_list,
                    'law_and_regulation_list'   => $law_and_regulation_list,
                    'training_knowledge_list'   => $training_knowledge_list,
                    'pamphlets_knowledge_list'   => $pamphlets_knowledge_list,
                    'booklets_knowledge_list'   => $booklets_knowledge_list,
                    'posters_knowledge_list'    => $posters_knowledge_list,
                    'knowledge_theme'           => $knowledge_theme,
                    'theme_list'                => $theme_list,
                    'flag'                      => false,
    
                ])->render();

                return view('knowledge_hub.theme_detail',[
        
                    'theme_list' => $theme_list,
                    'organization_list' => $knowladge_hub->getKnowladgeHubDistinctList('organization'),
                    'author_list' => $knowladge_hub->getKnowladgeHubDistinctList('author'),
        
                    'article_list'              => $article_list,
                    'data_set_list'             => $data_set_list,
                    'infographic_list'          => $infographic_list,
                    'knowladge_hub_list'        => $knowladge_hub_list,
                    'law_and_regulation_list'   => $law_and_regulation_list,
                    'training_knowledge_list'   => $training_knowledge_list,
                    'pamphlets_knowledge_list'   => $pamphlets_knowledge_list,
                    'booklets_knowledge_list'   => $booklets_knowledge_list,
                    'posters_knowledge_list'    => $posters_knowledge_list,
                    'knowledge_theme'           => $knowledge_theme,
                    'view'       => $view,
                ]);

                }
            }
            else
            {
                $article = new Article;
                $knowledge_theme = new KnowledgeTheme;
        
                $data_set = new DataSet;
                $infographic = new Infographic;
                $law_and_regulation = new LawAndRegulation;
                $other_knowladge = new OtherKnowladge;
                $knowladge_hub = new KnowladgeHub;
        
                $theme_list = $knowledge_theme->getAllKnowledgeTheme();
                $article_list_count   = $article->getAllArticlecount();
        
                $data_set_list_count   = $data_set->getAllDataSetcount();
        
                $info_graphics_list_count   = $infographic->getAllInfographiccount();
        
                $knowladge_list_count = $knowladge_hub->getAllKnowladgecount();
        
                $law_regulation_list_count = $law_and_regulation->getAllLawAndRegulationcount();
        
                $other_knowledge_list_count_train = $other_knowladge->getAllOtherKnowledgecounttrain();
                $other_knowledge_list_count_book = $other_knowladge->getAllOtherKnowledgecountbook();
                $other_knowledge_list_count_pamp = $other_knowladge->getAllOtherKnowledgecountpamp();
                $other_knowledge_list_count_post = $other_knowladge->getAllOtherKnowledgecountpost();
        
                $view = view('knowledge_hub.component.component',[
        
                        'article_list'   => $article->getAllArticle(),
        
                        'data_set_list'   => $data_set->getAllDataSet(),
        
                        'info_graphics_list'   => $infographic->getAllInfographic(),
        
                        'knowladge_list' => $knowladge_hub->getAllKnowladge(),
        
                        'theme_list'     => $theme_list,
        
                        'other_knowledge_list' => $other_knowladge->getAllOtherKnowledge(),
        
                        'law_regulation_list' => $law_and_regulation->getAllLawAndRegulation(),
        
                        'flag'              => false,
        
        
                    ])->render();
        
                return view('knowledge_hub.index',[
        
                    'theme_list' => $theme_list,
        
                    'organization_list' => $knowladge_hub->getKnowladgeHubDistinctList('organization'),
                    'author_list' => $knowladge_hub->getKnowladgeHubDistinctList('author'),
        
                                'article_list_count'   => $article_list_count,
        
                                'data_set_list_count'   => $data_set_list_count,
        
                                'info_graphics_list_count'   => $info_graphics_list_count,
        
                                'knowladge_list_count' => $knowladge_list_count,
        
        
                                'law_regulation_list_count' => $law_regulation_list_count,
        
                                'other_knowledge_list_count_train' => $other_knowledge_list_count_train,
                                'other_knowledge_list_count_book' => $other_knowledge_list_count_book,
                                'other_knowledge_list_count_pamp' => $other_knowledge_list_count_pamp,
                                'other_knowledge_list_count_post' => $other_knowledge_list_count_post,
        
                    'view'       => $view,
                ]);

            }
           


        }
        catch(DecryptException $e)
        {

        }
      
    }



		public function knowledgehubHome()
    {
        $theme = new Theme;
        $knowledge_theme = new KnowledgeTheme;
        $article = new Article;
        $data_set = new DataSet;
        $infographic = new Infographic;
        $law_and_regulation = new LawAndRegulation;
        $other_knowladge = new OtherKnowladge;
        $knowladge_hub = new KnowladgeHub;

        $theme_list = $knowledge_theme->getAllKnowledgeTheme();
		$article_list_count   = $article->getAllArticlecount();

				$data_set_list_count   = $data_set->getAllDataSetcount();

				$info_graphics_list_count   = $infographic->getAllInfographiccount();

				$knowladge_list_count = $knowladge_hub->getAllKnowladgecount();


				$law_regulation_list_count = $law_and_regulation->getAllLawAndRegulationcount();

				$other_knowledge_list_count_train = $other_knowladge->getAllOtherKnowledgecounttrain();
				$other_knowledge_list_count_book = $other_knowladge->getAllOtherKnowledgecountbook();
				$other_knowledge_list_count_pamp = $other_knowladge->getAllOtherKnowledgecountpamp();
				$other_knowledge_list_count_post = $other_knowladge->getAllOtherKnowledgecountpost();

        $view = view('knowledge_hub.component.component',[

                'article_list'   => $article->getAllArticle(),

                'data_set_list'   => $data_set->getAllDataSet(),

                'info_graphics_list'   => $infographic->getAllInfographic(),

                'knowladge_list' => $knowladge_hub->getAllKnowladge(),

                'theme_list'     => $theme_list,

                'other_knowledge_list' => $other_knowladge->getAllOtherKnowledge(),

                'law_regulation_list' => $law_and_regulation->getAllLawAndRegulation(),
                'flag'              => false,

            ])->render();

    	return view('knowledge_hub.khhome',[

            'theme_list' => $theme_list,

            'organization_list' => $knowladge_hub->getKnowladgeHubDistinctList('organization'),
            'author_list' => $knowladge_hub->getKnowladgeHubDistinctList('author'),

						'article_list_count'   => $article_list_count,

						'data_set_list_count'   => $data_set_list_count,

						'info_graphics_list_count'   => $info_graphics_list_count,

						'knowladge_list_count' => $knowladge_list_count,


						'law_regulation_list_count' => $law_regulation_list_count,

						'other_knowledge_list_count_train' => $other_knowledge_list_count_train,
						'other_knowledge_list_count_book' => $other_knowledge_list_count_book,
						'other_knowledge_list_count_pamp' => $other_knowledge_list_count_pamp,
						'other_knowledge_list_count_post' => $other_knowledge_list_count_post,

            'view'       => $view,
    	]);
    }

    public function getArticleDetail($id)
    {
        try{

            $id = decrypt($id);

            $article = new Article;
            $curr_article = $article->getArticleById($id);
            if(isset($curr_article->id))
            {
                return view('knowledge_hub.article_hub_detail',[
                    'knowladge' => $curr_article,
                ]);
            }
        }
        catch(Exception $e)
        {

        }


        return redirect()->back();
    }


		public function getlawDetail($id)
		{
				try{

                    $id = decrypt($id);
                    $law_and_regulation = new LawAndRegulation;
                    $curr_law_and_regulation = $law_and_regulation->getLawAndRegulationById($id);

                    if(isset($curr_law_and_regulation->id))
                    {
                            return view('knowledge_hub.knowledge_hub_detail',[
                                    'knowladge' => $curr_law_and_regulation,
                            ]);
                    }
				}
				catch(Exception $e)
				{

				}


				return redirect()->back();
		}

		public function getdataDetail($id)
		{
				try{

						$id = decrypt($id);

                        $data_set = new DataSet;
						$curr_data_set = $data_set->getDataSetById($id);

						if(isset($curr_data_set->id))
						{
								return view('knowledge_hub.knowledge_hub_detail',[
										'knowladge' => $curr_data_set,
								]);
						}
				}
				catch(Exception $e)
				{

				}


				return redirect()->back();
		}


		public function getinfoDetail($id)
		{
				try{

						$id = decrypt($id);
                        $infographics = new Infographic;
						$curr_infographics = $infographics->getInfographicById($id);

						if(isset($curr_infographics->id))
						{
								return view('knowledge_hub.knowledge_hub_detail',[
										'knowladge' => $curr_infographics,
								]);
						}
				}
				catch(Exception $e)
				{

				}


				return redirect()->back();
		}



		public function getotherDetail($id)
		{
				try{

						$id = decrypt($id);
                        $other_knowladge = new OtherKnowladge;
						$curr_other_knowladge = $other_knowladge->getOtherKnowledgeById($id);

						if(isset($curr_other_knowladge->id))
						{
								return view('knowledge_hub.knowledge_hub_detail',[
										'knowladge' => $curr_other_knowladge,
								]);
						}
				}
				catch(Exception $e)
				{

				}


				return redirect()->back();
		}


    public function knowledgeHubDetail($id)
    {
        try{

            $id = decrypt($id);

            $knowladge_hub = new KnowladgeHub;
            $curr_knowladge_hub = $knowladge_hub->getKnowladgeHubById($id);

            if(isset($curr_knowladge_hub->id))
            {
                return view('knowledge_hub.knowledge_hub_detail',[
                    'knowladge' => $curr_knowladge_hub,
                ]);
            }
        }
        catch(Exception $e)
        {

        }


    	return redirect()->back();
    }


    public function storeKnowladgeHub(KnowladgeHubRequest $request)
    {
        try
        {
            $form_collect = $request->input();

            $form_collect['knowledge_theme'] = decrypt($form_collect['knowledge_theme']);

			$form_collect['tagname'] = $form_collect['tagname'];
			Session::put('tagname', $form_collect['tagname']);
            $form_collect['thumbnail'] = $request->thumbnail;

            $form_collect['pdf']  = $request->pdf;

            $knowladge_hub = new KnowladgeHub;
            $curr_knowladge_hub = $knowladge_hub->storeKnowladgeHub($form_collect);

            if(isset($curr_knowladge_hub->id))
            {
                Session::flash('success', "Report has been added successfully.");
                EF::createLogs('Report has been added successfully');

                if($request->ajax())
                {
                    return 1;
                }

            }
        }
        catch(Exception $e)
        {

        }

        return redirect()->back();

    }

    public function updateKnowladgeHub(KnowladgeHubRequest $request)
    {
        try
        {
            if($request->isMethod('post'))
            {
                $form_collect = $request->input();

                $form_collect['knowledge_theme'] = decrypt($form_collect['knowledge_theme']);

                $form_collect['knowladge_hub'] = decrypt($form_collect['knowladge_hub']);

                $form_collect['thumbnail'] = $request->thumbnail;

                $form_collect['pdf']  = $request->pdf;

                $knowladge_hub = new KnowladgeHub;

                $curr_knowladge_hub = $knowladge_hub->updateKnowladgeHub($form_collect);

                if(isset($curr_knowladge_hub->id))
                {
                    Session::flash('success', "Report has been updated successfully.");
                    EF::createLogs('Report has been updated successfully');


                    if($request->ajax())
                    {
                        return 1;
                    }

                }
            }
            else
            {
                $id = decrypt($request->id);

                $knowladge_hub = new KnowladgeHub;
                $knowladge_theme = new KnowledgeTheme;
                

                $curr_knowladge_hub = $knowladge_hub->getKnowladgeHubById($id);

                if($curr_knowladge_hub->id)
                {
                    return view('knowledge_hub.modals.update_report',[
                        'knowladge'  => $curr_knowladge_hub,
                        'theme'      => $curr_knowladge_hub->knowledgeTheme,
                        'theme_list' => $knowladge_theme->getAllKnowledgeTheme(),

                    ]);
                }
            }

        }
        catch(Exception $e)
        {

        }

        return redirect()->back();

    }

    public function storeArticle(KnowladgeHubRequest $request)
    {
        try
        {
            $form_collect = $request->input();
			Session::put('tagname', $form_collect['tagname']);
            $form_collect['knowledge_theme'] = decrypt($form_collect['knowledge_theme']);
			$form_collect['pdf']  = $request->pdf;

            $article = new Article;
            $curr_article = $article->storeArticle($form_collect);

            if(isset($curr_article->id))
            {
                Session::flash('success', "Article has been added successfully.");
                EF::createLogs('Article has been added successfully');


                    if($request->ajax())
                    {
                        return 1;
                    }

            }
        }
        catch(Exception $e)
        {

        }

        return redirect()->back();

    }

    public function updateArticle(KnowladgeHubRequest $request)
    {
        try
        {
            if($request->isMethod('post'))
            {
                $form_collect = $request->input();

                $form_collect['knowledge_theme'] = decrypt($form_collect['knowledge_theme']);

                $form_collect['article'] = decrypt($form_collect['article']);
				$form_collect['pdf']  = $request->pdf;
                $article = new Article;
                $curr_article = $article->updateArticle($form_collect);

                if(isset($curr_article->id))
                {
                    Session::flash('success', "Article has been updated successfully.");
                    EF::createLogs('Article has been updated successfully');


                    if($request->ajax())
                    {
                        return 1;
                    }

                }
            }
            else
            {

                $id = decrypt($request->id);

                $knowladge_hub = new KnowladgeHub;
                $knowladge_theme = new KnowledgeTheme;
                $article = new Article;

                $curr_article = $article->getArticleById($id);

                if($curr_article->id)
                {
                    return view('knowledge_hub.modals.update_article',[
                        'article'  => $curr_article,
                        'theme'      => $curr_article->knowledgeTheme,
                        'theme_list' => $knowladge_theme->getAllKnowledgeTheme(),

                    ]);
                }
            }

        }
        catch(Exception $e)
        {

        }

        return redirect()->back();

    }


    public function removeKnowledgeHub($id)
    {
        try{
            $id = decrypt($id);
            $knowladge_hub = new KnowladgeHub;
            if($knowladge_hub->removeKnowladgeHub($id))
            {
                Session::flash('success', "Report has been removed successfully.");

                EF::createLogs('Report has been removed successfully');

            }
        }
        catch(Exception $e)
        {

        }

        return redirect()->back();
    }

    public function removeArticle($id)
    {
        try{
            $id = decrypt($id);
            $article = new Article;
            if($article->removeArticle($id))
            {
                Session::flash('success', "Article has been removed successfully.");

                EF::createLogs('Article has been removed successfully');

            }
        }
        catch(Exception $e)
        {

        }

        return redirect()->back();
    }


    public function storeDataSet(KnowladgeHubRequest $request)
    {
        try
        {
            $form_collect = $request->input();
            Session::put('tagname', $form_collect['tagname']);
            $form_collect['knowledge_theme'] = decrypt($form_collect['knowledge_theme']);
            $form_collect['pdf']  = $request->pdf;

            $data_set = new DataSet;

            $curr_data_set = $data_set->storeDataSet($form_collect);

            if(isset($curr_data_set->id))
            {
                Session::flash('success', "Data Set has been added successfully.");

                EF::createLogs('Data set has been added successfully');


                    if($request->ajax())
                    {
                        return 1;
                    }

            }
        }
        catch(Exception $e)
        {

        }

        return redirect()->back();

    }

    public function updateDataSet(KnowladgeHubRequest $request)
    {
        try
        {
            if($request->isMethod('post'))
            {
                $form_collect = $request->input();

                $form_collect['knowledge_theme'] = decrypt($form_collect['knowledge_theme']);

                $form_collect['data_set'] = decrypt($form_collect['data_set']);
				$form_collect['pdf']  = $request->pdf;

                $data_set = new DataSet;

                $curr_data_set = $data_set->updateDataSet($form_collect);

                if(isset($curr_data_set->id))
                {
                    Session::flash('success', "Data Set has been updated successfully.");

                     EF::createLogs('Data set has been updated successfully');


                    if($request->ajax())
                    {
                        return 1;
                    }

                }
            }
            else
            {

                $id = decrypt($request->id);
                $data_set = new DataSet;
                $knowladge_theme = new KnowledgeTheme;

                $curr_data_set = $data_set->getDataSetById($id);

                if($curr_data_set->id)
                {
                    return view('knowledge_hub.modals.update_data_set',[
                        'data_set'   => $curr_data_set,
                        'theme'      => $curr_data_set->knowledgeTheme,
                        'theme_list' => $knowladge_theme->getAllKnowledgeTheme(),

                    ]);
                }
            }

        }
        catch(Exception $e)
        {

        }

        return redirect()->back();

    }


    public function removeDataSet($id)
    {
        try{
            $id = decrypt($id);
            $data_set = new DataSet;

            if($data_set->removeDataSet($id))
            {
                Session::flash('success', "Data Set has been removed successfully.");

                EF::createLogs('Data set has been removed successfully');

            }
        }
        catch(Exception $e)
        {

        }

        return redirect()->back();
    }

    public function storeInfographic(KnowladgeHubRequest $request)
    {
        try
        {

            $form_collect = $request->input();
			Session::put('tagname', $form_collect['tagname']);
            $form_collect['knowledge_theme'] = decrypt($form_collect['knowledge_theme']);

            $form_collect['image'] = $request->image;

            $infographics = new Infographic;

            $curr_infographic = $infographics->storeInfographic($form_collect);

            if(isset($curr_infographic->id))
            {
                Session::flash('success', "Infographic has been added successfully.");

                EF::createLogs('Info graphic has been added successfully');


                    if($request->ajax())
                    {
                        return 1;
                    }

            }
        }
        catch(Exception $e)
        {

        }

        return redirect()->back();

    }

    public function updateInfographic(KnowladgeHubRequest $request)
    {
        try
        {

            if($request->isMethod('post'))
            {
                $form_collect = $request->input();

                $form_collect['info_graphics'] = decrypt($form_collect['info_graphics']);

                $form_collect['knowledge_theme'] = decrypt($form_collect['knowledge_theme']);


                $form_collect['image'] = $request->image;

                $infographics = new Infographic;

                $infographic = $infographics->updateInfographic($form_collect);

                if(isset($infographic->id))
                {
                    Session::flash('success', "Info graphic has been update successfully.");

                    EF::createLogs('Info graphic has been update successfully');


                        if($request->ajax())
                        {
                            return 1;
                        }

                }
            }
            else
            {
                $id = decrypt($request->id);

                $knowladge_theme = new KnowledgeTheme;
                $infographics = new Infographic;

                $curr_infographic = $infographics->getInfographicById($id);

                if($curr_infographic->id)
                {
                    return view('knowledge_hub.modals.update_infographic',[
                        'info_graphic'   => $curr_infographic,
                        'theme'          => $curr_infographic->knowledgeTheme,
                        'theme_list'     => $knowladge_theme->getAllKnowledgeTheme(),

                    ]);
                }
            }


        }
        catch(Exception $e)
        {

        }

        return redirect()->back();

    }

    public function removeInfographic($id)
    {
        try{
            $id = decrypt($id);
            $infographics = new Infographic;

            if($infographics->removeInfographic($id))
            {
                Session::flash('success', "Infographic has been removed successfully.");

                EF::createLogs('Infographic has been removed successfully');

            }
        }
        catch(Exception $e)
        {

        }

        return redirect()->back();
    }


    public function storeOtherKnowledge(KnowladgeHubRequest $request)
    {
        try
        {
            $form_collect = $request->input();

            $form_collect['knowledge_theme'] = decrypt($form_collect['knowledge_theme']);
			Session::put('tagname', $form_collect['tagname']);
			$form_collect['pdf']  = $request->pdf;
            $other_knowladge = new OtherKnowledge;

            $other = $other_knowladge->storeOtherKnowledge($form_collect);

            if(isset($other->id))
            {
                Session::flash('success', ucfirst($other->type)." has been added successfully.");
                EF::createLogs(ucfirst($other->type).' has been added successfully');


                    if($request->ajax())
                    {
                        return 1;
                    }

            }
        }
        catch(Exception $e)
        {

        }

        return redirect()->back();

    }

    public function updateOtherKnowledge(KnowladgeHubRequest $request)
    {
        try
        {
            if($request->isMethod('post'))
            {
                $form_collect = $request->input();

                $form_collect['knowledge_theme'] = decrypt($form_collect['knowledge_theme']);

                $form_collect['other_knowledge'] = decrypt($form_collect['other_knowledge']);
				$form_collect['pdf']  = $request->pdf;

                $other_knowladge = new OtherKnowledge;

                $curr_other_knowladge = $other_knowladge->updateOtherKnowledge($form_collect);

                if(isset($curr_other_knowladge->id))
                {
                    Session::flash('success', ucfirst($curr_other_knowladge->type)." has been updated successfully.");
                    EF::createLogs(ucfirst($curr_other_knowladge->type).' has been updated successfully');


                    if($request->ajax())
                    {
                        return 1;
                    }

                }
            }
            else
            {

                $id = decrypt($request->id);
                $knowladge_theme = new KnowledgeTheme;
                $other_knowladge = new OtherKnowledge;

                $curr_other_knowladge = $other_knowladge->getOtherKnowledgeById($id);

                if($curr_other_knowladge->id)
                {
                    return view('knowledge_hub.modals.update_other',[
                        'other'  => $curr_other_knowladge,
                        'theme'      => $curr_other_knowladge->knowledgeTheme,
                        'theme_list' => $knowladge_theme->getAllKnowledgeTheme(),

                    ]);
                }
            }

        }
        catch(Exception $e)
        {

        }

        return redirect()->back();

    }




    public function removeOtherKnowledge($id)
    {
        try{
            $id = decrypt($id);

            $other_knowladge = new OtherKnowledge;

            if($other_knowladge->removeOtherKnowledge($id))
            {
                Session::flash('success', "Other has been removed successfully.");

                EF::createLogs('Record has been removed successfully');

            }
        }
        catch(Exception $e)
        {

        }

        return redirect()->back();
    }

    public function resetKnowladgeHub()
    {

        $article = new Article;
        $data_set = new DataSet;
        $infographic = new Infographic;
        $knowladge_hub = new KnowladgeHub;
        $other_knowladge = new OtherKnowladge;
        $knowladge_theme = new KnowledgeTheme;
        $law_and_regulation = new LawAndRegulation;

        $theme_list = $knowladge_theme->getAllKnowledgeTheme();

        $view = view('knowledge_hub.component.component',[

                'article_list'   => $article->getAllArticle(),

                'data_set_list'   => $data_set->getAllDataSet(),

                'info_graphics_list'   => $infographic->getAllInfographic(),

                'knowladge_list' => $knowladge_hub->getAllKnowladge(),

                'theme_list'     => $theme_list,

                'other_knowledge_list' => $other_knowladge->getAllOtherKnowledge(),

            ])->render();

        return $view;
    }


    public function showMultipleThemeData(Request $request){

        $data = ['status' => 0, 'view' => ''];

        try{

            $theme = new Theme;
            $article = new Article;
            $data_set = new DataSet;
            $infographic = new Infographic;
            $knowladge_hub = new KnowladgeHub;
            $other_knowladge = new OtherKnowladge;
            $knowladge_theme = new KnowledgeTheme;
            $law_and_regulation = new LawAndRegulation;

            $form_collect = $request->input();
            $theme_ids = [];

            $count = 0;
            if(isset($form_collect['theme_ids']))
            {
                foreach ($form_collect['theme_ids'] as $rows) {

                    array_push($theme_ids,decrypt($rows));
    
                }

            }
            else{
                $theme_ids[] = 0;
            }
            

            $theme_list = $knowladge_theme->getAllKnowledgeTheme();

            $article_list = $article->getArticleByKnowledgeThemeId($theme_ids);

            $data_set_list = $data_set->getDataSetByKnowledgeThemeId($theme_ids);

            $info_graphics_list = $infographic->getInfographicByKnowledgeThemeId($theme_ids);

            $knowladge_list = $knowladge_hub->getKnowladgeByKnowledgeThemeId($theme_ids);

            $other_knowledge_list = $other_knowladge->getOtherKnowledgeByKnowledgeThemeId($theme_ids);

            $law_regulation = $law_and_regulation->getLawAndRegulationByKnowledgeThemeId($theme_ids);

            $flag = false;


            $data['view'] =  view('knowledge_hub.component.component',[

                'article_list'   => $article_list,

                'data_set_list'   => $data_set_list,

                'info_graphics_list'   => $info_graphics_list,

                'knowladge_list' => $knowladge_list,

                'other_knowledge_list' => $other_knowledge_list,

                'law_regulation_list' => $law_regulation,

                'theme_list'     => $theme_list,

                'flag'          =>  $flag

            ])->render();
        


        }
        catch(DecryptException $e){
            
        }


        return $data;
     
    }

    public function searchKnowladgeHub(Request $request)
    {
        $data = ['status' => 0, 'view' => ''];
        try{
            $theme = new Theme;
            $article = new Article;
            $data_set = new DataSet;
            $infographic = new Infographic;
            $knowladge_hub = new KnowladgeHub;
            $other_knowladge = new OtherKnowladge;
            $knowladge_theme = new KnowledgeTheme;
            $law_and_regulation = new LawAndRegulation;

            $request->validate([
                 // 'theme'             => ['required', new ExistRule('themes','id')],
                 'search_value'           => 'required',
								 // 'keyword'           => 'required',
            ]);

            $value     = ($request->search_value);
            $keyword = ($request->keyword);

            $theme_list = $knowladge_theme->getAllKnowledgeTheme();

            $article_list = $article->getArticleByKnowledgeThemekeyword($value,$keyword);

            $data_set_list = $data_set->getDataSetByKnowledgeThemekeyword($value,$keyword);

            $info_graphics_list = $infographic->getInfographicByKnowledgeThemekeyword($value,$keyword);

            $knowladge_list = $knowladge_hub->getKnowladgeByKnowledgeThemekeyword($value,$keyword);

            $other_knowledge_list = $other_knowladge->getOtherKnowledgeByKnowledgeThemekeyword($value,$keyword);

            $law_regulation = $law_and_regulation->getLawAndRegulationByKnowledgeThemekeyword($value,$keyword);

            $check = @count($other_knowledge_list) + @count($knowladge_list) + @count($info_graphics_list) + @count($data_set_list) + @count($article_list) + @count($law_regulation);

            $data['status'] = 1;

            if($check > 0)
            {
                $data['status'] = 2;

            }
                $data['view'] =  view('knowledge_hub.component.component',[

                    'article_list'   => $article_list,

                    'data_set_list'   => $data_set_list,

                    'info_graphics_list'   => $info_graphics_list,

                    'knowladge_list' => $knowladge_list,

                    'other_knowledge_list' => $other_knowledge_list,

                    'law_regulation_list' => $law_regulation,

                    'theme_list'     => $theme_list,

                ])->render();



        }
        catch(DecryptException $e)
        {
        }


        return $data;

    }

    public function searchKnowladgeTheme(Request $request)
    {
          if($request->ajax())
          {
                $output="";
                $search = strtolower($request->search);

                $knowladge_theme = new KnowledgeTheme;

                $theme_list = $knowladge_theme->searchKnowledgeTheme($search);

                if($theme_list->count() == 0)
                {
                  $output.=
                  '<li class="list-group-item"> No Data Found</li>';
                }
                if($theme_list)
                {

                    foreach ($theme_list as $key => $thems) {
                      $myroute = route('indicators', Crypt::encrypt($thems->id));
                        $output.=
                        '<li class="list-group-item"><a onclick="searchKnowladgeHub(this);">'.$thems->name.'</a></li>';
                     }

                    return Response($output);
                }
        }
    }


    public function storeLawAndRegulation(KnowladgeHubRequest $request)
    {
        try
        {
            $form_collect = $request->input();

            $form_collect['knowledge_theme'] = decrypt($form_collect['knowledge_theme']);
            Session::put('tagname', $form_collect['tagname']);
            $form_collect['pdf']  = $request->pdf;

            $law_and_regulation = new LawAndRegulation;

            $curr_law_regulation = $law_and_regulation->storeLawAndRegulation($form_collect);

            if(isset($curr_law_regulation->id))
            {
                Session::flash('success', "Law and regulation has been added successfully.");

                EF::createLogs('Law and regulation has been added successfully');


                    if($request->ajax())
                    {
                        return 1;
                    }

            }
        }
        catch(Exception $e)
        {

        }

        return redirect()->back();

    }

    public function updateLawAndRegulation(KnowladgeHubRequest $request)
    {
        try
        {
            if($request->isMethod('post'))
            {
                $form_collect = $request->input();

                $form_collect['knowledge_theme'] = decrypt($form_collect['knowledge_theme']);

                $form_collect['law_regulation'] = decrypt($form_collect['law_regulation']);
				$form_collect['pdf']  = $request->pdf;

                $law_and_regulation = new LawAndRegulation;

                $curr_law_regulation = $law_and_regulation->updateLawAndRegulation($form_collect);

                if(isset($curr_law_regulation->id))
                {
                    Session::flash('success', "Law and regulation has been updated successfully.");

                     EF::createLogs('Law and regulation has been updated successfully');


                    if($request->ajax())
                    {
                        return 1;
                    }

                }
            }
            else
            {

                $id = decrypt($request->id);

                $knowladge_theme = new KnowledgeTheme;
                $law_and_regulation = new LawAndRegulation;

                $curr_law_regulation = $law_and_regulation->getLawAndRegulationById($id);

                if($curr_law_regulation->id)
                {
                    return view('knowledge_hub.modals.update_law_regulation',[
                        'law_regulation'   => $curr_law_regulation,
                        'theme'      => $curr_law_regulation->knowledgeTheme,
                        'theme_list' => $knowladge_theme->getAllKnowledgeTheme(),

                    ]);
                }
            }

        }
        catch(Exception $e)
        {

        }

        return redirect()->back();

    }


    public function removeLawAndRegulation($id)
    {
        try{
            $id = decrypt($id);
            $law_and_regulation = new LawAndRegulation;

            if($law_and_regulation->removeLawAndRegulation($id))
            {
                Session::flash('success', "Law and regulation has been removed successfully.");

                EF::createLogs('Law and regulation has been removed successfully');

            }
        }
        catch(Exception $e)
        {

        }

        return redirect()->back();
    }






}
