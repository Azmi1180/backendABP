import { useState } from 'react'
import { 
    Newspaper, 
    Home, 
    Bookmark, 
    Search, 
    X, 
    Bot, 
    ChevronDown,
    Globe,
    Tag,
    Link,
    Save,
    Menu
} from 'lucide-react'

export default function SavedArticles() {
    const [selectedArticle, setSelectedArticle] = useState(null);
    const [sidebarOpen, setSidebarOpen] = useState(false);

    // Add CSS animations
    const modalStyles = `
    @keyframes modalSlideIn {
      from {
        opacity: 0;
        transform: translateY(-50px) scale(0.95);
      }
      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }
    
    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
    
    .animate-fade-in {
      animation: fadeIn 0.2s ease-out;
    }
  `;

    const savedArticles = [
        {
            id: 1,
            title: "Tech Giants Announce Breakthrough in Quantum Computing",
            source: "Tech Chronicle",
            time: "about 2 hours ago",
            category: "Technology",
            summary: "A new quantum processor \"Quasar\" promises to revolutionize complex calculations, marking a major step in computing history.",
            fullContent: "In a landmark announcement today, a consortium of leading technology firms revealed a significant breakthrough in quantum computing. Their new processor, \"Quasar,\" is reportedly capable of performing calculations previously thought impossible, potentially revolutionizing fields like medicine, materials science, and artificial intelligence. Experts are hailing this as a pivotal moment, though widespread practical applications are still years away. The development involved a decade of research and billions in funding, underscoring the immense challenge and potential reward of harnessing quantum mechanics for computation. Further details are expected at an upcoming industry conference."
        },
        {
            id: 2,
            title: "Global Markets React to New Economic Policies",
            source: "Financial Times",
            time: "about 4 hours ago",
            category: "Business",
            summary: "New economic policies trigger mixed reactions and volatility across global financial markets.",
            fullContent: "Global financial markets experienced significant volatility today as investors digested the implications of newly announced economic policies. The measures, which include changes to monetary policy and fiscal spending, have created uncertainty among traders and analysts. While some sectors showed gains, others declined sharply as market participants reassessed their positions. Economic experts remain divided on the long-term impacts of these policy changes, with some predicting sustained growth while others warn of potential inflationary pressures."
        },
        {
            id: 3,
            title: "Global Markets React to New Economic Policies",
            source: "Financial Times",
            time: "about 4 hours ago",
            category: "Business",
            summary: "New economic policies trigger mixed reactions and volatility across global financial markets.",
            fullContent: "Global financial markets experienced significant volatility today as investors digested the implications of newly announced economic policies. The measures, which include changes to monetary policy and fiscal spending, have created uncertainty among traders and analysts. While some sectors showed gains, others declined sharply as market participants reassessed their positions. Economic experts remain divided on the long-term impacts of these policy changes, with some predicting sustained growth while others warn of potential inflationary pressures."
        },
    ];

    return (
        <>
            <style>{modalStyles}</style>
            <div className="flex min-h-screen bg-gray-50">
                {/* Mobile Sidebar Overlay */}
                {sidebarOpen && (
                    <div 
                        className="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"
                        onClick={() => setSidebarOpen(false)}
                    />
                )}

                {/* Sidebar - Fixed */}
                <aside className={`
                    fixed left-0 top-0 h-full w-64 bg-[#003479] text-white z-50 transform transition-transform duration-300 ease-in-out
                    ${sidebarOpen ? 'translate-x-0' : '-translate-x-full'}
                    lg:translate-x-0
                `}>
                    <div className="p-4">
                        <div className="text-xl font-bold mb-8 flex items-center justify-between">
                            <div className="flex items-center gap-2">
                                <Newspaper className="w-6 h-6" />
                                NewsAIgle
                            </div>
                            <button 
                                className="lg:hidden"
                                onClick={() => setSidebarOpen(false)}
                            >
                                <X className="w-5 h-5" />
                            </button>
                        </div>
                        <nav className="flex flex-col">
                            <a href="/home" className='flex w-full'>
                                <button className="hover:bg-blue-500 py-2 px-4 rounded-lg text-left mb-2 flex items-center gap-2 w-full">
                                <Home className="w-4 h-4" />
                                Home
                            </button>
                            </a>
                            
                            <button className="bg-blue-500 py-2 px-4 rounded-lg text-left flex items-center gap-2">
                                <Bookmark className="w-4 h-4" />
                                Saved Articles
                            </button>
                        </nav>
                    </div>
                </aside>

                {/* Main Content */}
                <main className="flex-1 lg:ml-64">
                    {/* Header - Fixed */}
                    <div className="fixed top-0 right-0 left-0 lg:left-64 bg-white shadow-sm px-6 py-4 z-30">
                        <div className="flex items-center gap-2">
                            <button 
                                className="lg:hidden mr-3"
                                onClick={() => setSidebarOpen(true)}
                            >
                                <Menu className="w-6 h-6" />
                            </button>
                            <Newspaper className="w-6 h-6" />
                            <span className="text-xl font-bold text-gray-800">NewsAIgle</span>
                        </div>
                    </div>

                    {/* Content with top padding to account for fixed header */}
                    <div className="pt-20 p-6 bg-gray-100 min-h-screen">
                        {/* Page Title */}
                        <div className="bg-white rounded-lg shadow-sm p-6 mb-6">
                            <div className="flex items-center gap-2">
                                <Bookmark className="text-blue-500 w-6 h-6" />
                                <h1 className="text-2xl font-bold text-gray-900">Saved Articles</h1>
                            </div>
                        </div>

                        {/* Saved Articles Grid */}
                        <div className="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                            {savedArticles.map((article) => (
                                <div
                                    key={article.id}
                                    className="bg-white rounded-lg shadow-sm overflow-hidden cursor-pointer hover:shadow-md transition-all duration-200"
                                    onClick={() => setSelectedArticle(article)}
                                >
                                    <div className="bg-gray-200 flex items-center justify-center h-48 text-gray-400 text-lg font-medium">
                                        600 × 400
                                    </div>
                                    <div className="p-4">
                                        <h3 className="font-bold text-lg text-gray-900 mb-2 line-clamp-2">
                                            {article.title}
                                        </h3>
                                        <p className="text-sm text-gray-500 mb-2">
                                            {article.source} • {article.time}
                                        </p>
                                        <span className={`inline-block text-xs px-2 py-1 rounded-full mb-3 bg-gray-200`}>
                                            {article.category}
                                        </span>
                                        <p className="text-sm text-gray-600 line-clamp-2 mb-4">
                                            {article.summary}
                                        </p>
                                        
                                        {/* Action Buttons */}
                                        <div className="flex gap-2">
                                            <button 
                                                className="flex items-center gap-1 px-3 py-1 text-sm text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded"
                                                onClick={(e) => {
                                                    e.stopPropagation();
                                                    // Handle summarize action
                                                }}
                                            >
                                                <Bot className="w-4 h-4" />
                                                Summarize
                                            </button>
                                            <button 
                                                className="flex items-center gap-1 px-3 py-1 text-sm text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded"
                                                onClick={(e) => {
                                                    e.stopPropagation();
                                                    // Handle read more action
                                                }}
                                            >
                                                <Link className="w-4 h-4" />
                                                Read More
                                            </button>
                                            <button 
                                                className="flex items-center gap-1 px-3 py-1 text-sm text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded"
                                                onClick={(e) => {
                                                    e.stopPropagation();
                                                    // Handle save/remove action
                                                }}
                                            >
                                                <Save className="w-4 h-4 fill-current" />
                                                Saved
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>

                        {/* Empty State (when no saved articles) */}
                        {savedArticles.length === 0 && (
                            <div className="bg-white rounded-lg shadow-sm p-12 text-center">
                                <Bookmark className="w-16 h-16 text-gray-400 mx-auto mb-4" />
                                <h3 className="text-xl font-semibold text-gray-900 mb-2">No saved articles yet</h3>
                                <p className="text-gray-600 mb-6">
                                    Start saving articles you want to read later by clicking the save button on any article.
                                </p>
                                <button className="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 flex items-center gap-2 mx-auto">
                                    <Home className="w-4 h-4" />
                                    Browse Articles
                                </button>
                            </div>
                        )}
                    </div>

                    {/* Modal */}
                    {selectedArticle && (
                        <div
                            className="fixed inset-0 backdrop-blur-sm flex items-center justify-center p-4 z-50 animate-fade-in"
                            style={{ backgroundColor: 'rgba(0, 0, 0, 0.5)' }}
                            onClick={(e) => {
                                if (e.target === e.currentTarget) {
                                    setSelectedArticle(null);
                                }
                            }}
                        >
                            <div className="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto transform transition-all duration-300"
                                style={{
                                    animation: 'modalSlideIn 0.3s ease-out'
                                }}
                            >
                                <div className="p-6">
                                    <div className="flex justify-between items-start mb-4">
                                        <h2 className="text-2xl font-bold text-gray-900 pr-4">
                                            {selectedArticle.title}
                                        </h2>
                                        <button
                                            onClick={() => setSelectedArticle(null)}
                                            className="text-gray-400 hover:text-gray-600 text-2xl flex-shrink-0"
                                        >
                                            <X className="w-6 h-6" />
                                        </button>
                                    </div>

                                    <p className="text-sm text-gray-500 mb-4">
                                        Source: {selectedArticle.source} | Category: {selectedArticle.category}
                                    </p>

                                    <div className="flex flex-col lg:flex-row gap-6 mb-6">
                                        <div className="flex-1">
                                            <h3 className="text-lg font-semibold mb-3">Full Article</h3>
                                            <p className="text-gray-700 leading-relaxed">
                                                {selectedArticle.fullContent}
                                            </p>
                                        </div>

                                        <div className="lg:w-80">
                                            <h3 className="text-lg font-semibold mb-3">AI Summary</h3>
                                            <button className="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors flex items-center justify-center gap-2">
                                                <Bot className="w-4 h-4" />
                                                Generate Summary
                                            </button>
                                        </div>
                                    </div>

                                    <div className="flex flex-wrap justify-end gap-3 pt-4 border-t">
                                        <button className="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-800">
                                            <Bot className="w-4 h-4" />
                                            Summarize
                                        </button>
                                        <button className="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-800">
                                            <Link className="w-4 h-4" />
                                            Read More
                                        </button>
                                        <button className="flex items-center gap-2 px-4 py-2 text-blue-600 hover:text-blue-800">
                                            <Save className="w-4 h-4 fill-current" />
                                            Saved
                                        </button>
                                        <button
                                            onClick={() => setSelectedArticle(null)}
                                            className="px-4 py-2 text-gray-600 hover:text-gray-800"
                                        >
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    )}
                </main>
            </div>
        </>
    );
}